<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\ContactMessage;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        
        // Rate limiting check
        $key = 'contact_form_' . $request->ip();
        $attempts = \Cache::get($key, 0);
        
        if ($attempts >= 5) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Too many requests. Please try again later.',
                    'alert' => [
                        'title' => 'Rate Limited',
                        'text' => 'Too many requests. Please try again later.',
                        'icon' => 'warning',
                        'confirmButtonText' => 'OK'
                    ]
                ], 429);
            }
            return redirect()->back()->with('error', 'Too many requests. Please try again later.');
        }

        // Spam detection
        $spamScore = $this->calculateSpamScore($request);
        if ($spamScore > 3) {
            \Log::warning('Spam detected from IP: ' . $request->ip() . ' Score: ' . $spamScore);
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your message appears to be spam. Please review and try again.',
                    'alert' => [
                        'title' => 'Spam Detected',
                        'text' => 'Your message appears to be spam. Please review and try again.',
                        'icon' => 'warning',
                        'confirmButtonText' => 'OK'
                    ]
                ], 400);
            }
            return redirect()->back()->with('error', 'Your message appears to be spam. Please review and try again.');
        }

        // Honeypot check (bot detection)
        if (!empty($request->website)) {
            \Log::warning('Bot detected from IP: ' . $request->ip() . ' - Honeypot triggered');
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid submission detected.'
                ], 400);
            }
            return redirect()->back()->with('error', 'Invalid submission detected.');
        }

        // Malicious content detection
        if ($this->containsMaliciousContent($request)) {
            \Log::warning('Malicious content detected from IP: ' . $request->ip());
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Your message contains inappropriate content. Please review and try again.'
                ], 400);
            }
            return redirect()->back()->with('error', 'Your message contains inappropriate content. Please review and try again.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20|regex:/^[0-9\+\-\s\(\)]+$/',
            'subject' => 'required|string|max:255|regex:/^[a-zA-Z0-9\s\-\.\,\!\?]+$/',
            'message' => 'required|string|min:10|max:1000',
        ], [
            'name.regex' => 'Name can only contain letters and spaces.',
            'phone.required' => 'Phone number is required.',
            'phone.regex' => 'Phone number contains invalid characters.',
            'subject.regex' => 'Subject contains invalid characters.',
            'message.min' => 'Message must be at least 10 characters long.',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please check your input and try again.',
                    'errors' => $validator->errors(),
                    'alert' => [
                        'title' => 'Validation Error',
                        'text' => 'Please check your input and try again.',
                        'icon' => 'error',
                        'confirmButtonText' => 'OK'
                    ]
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Save to database
        $contactMessage = ContactMessage::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'is_spam' => $spamScore > 3,
            'spam_score' => $spamScore,
        ]);

        // Send email notification
        try {
            $phoneInfo = $request->phone ? "Phone: {$request->phone}\n" : "";
            Mail::raw("
Name: {$request->name}
Email: {$request->email}
{$phoneInfo}Subject: {$request->subject}

Message:
{$request->message}

---
This message was sent from the Indsoft24.com contact form.
            ", function ($message) use ($request) {
                $message->to('indsoft24@gmail.com')
                        ->subject('New Contact Form Submission: ' . $request->subject)
                        ->from('indsoft24@gmail.com', 'Indsoft24.com Contact Form');
            });

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Thank you for your message! We will get back to you soon.',
                    'message_id' => $contactMessage->id,
                    'spam_score' => $spamScore,
                    'is_spam' => $spamScore > 3,
                    'alert' => [
                        'title' => 'Message Sent!',
                        'text' => 'Thank you for your message! We will get back to you soon.',
                        'icon' => 'success',
                        'confirmButtonText' => 'OK'
                    ]
                ]);
            }

            return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
        } catch (\Exception $e) {
            // Log the error but still show success to user
            \Log::error('Email sending failed: ' . $e->getMessage());
            
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, there was an error sending your message. Please try again or contact us directly.',
                    'error_details' => 'Email sending failed: ' . $e->getMessage(),
                    'error_code' => 'EMAIL_SEND_FAILED'
                ], 500);
            }
            
            return redirect()->back()->with('success', 'Thank you for your message! We will get back to you soon.');
        }

        // Increment rate limiting counter
        \Cache::put($key, $attempts + 1, 300); // 5 minutes
    }

    /**
     * Calculate spam score based on various factors
     */
    private function calculateSpamScore(Request $request)
    {
        $score = 0;
        $content = strtolower($request->name . ' ' . $request->subject . ' ' . $request->message);
        
        // Spam keywords
        $spamKeywords = [
            'viagra', 'casino', 'lottery', 'winner', 'congratulations', 'free money',
            'click here', 'buy now', 'limited time', 'act now', 'urgent', 'guaranteed',
            'no risk', '100% free', 'cash bonus', 'earn money', 'work from home',
            'make money', 'get rich', 'investment', 'crypto', 'bitcoin', 'forex',
            'loan', 'credit', 'debt', 'refinance', 'mortgage', 'insurance',
            'pharmacy', 'pills', 'supplements', 'weight loss', 'diet', 'fitness'
        ];
        
        foreach ($spamKeywords as $keyword) {
            if (strpos($content, $keyword) !== false) {
                $score += 2;
            }
        }
        
        // Check for excessive caps
        $capsRatio = strlen(preg_replace('/[^A-Z]/', '', $content)) / strlen($content);
        if ($capsRatio > 0.3) {
            $score += 2;
        }
        
        // Check for excessive exclamation marks
        $exclamationCount = substr_count($content, '!');
        if ($exclamationCount > 3) {
            $score += 1;
        }
        
        // Check for excessive links
        $linkCount = preg_match_all('/https?:\/\/[^\s]+/', $content);
        if ($linkCount > 2) {
            $score += 3;
        }
        
        // Check for repeated characters
        if (preg_match('/(.)\1{4,}/', $content)) {
            $score += 2;
        }
        
        // Check for suspicious email patterns
        if (preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}/i', $request->email)) {
            $emailDomain = substr(strrchr($request->email, "@"), 1);
            $suspiciousDomains = ['tempmail', '10minutemail', 'guerrillamail', 'mailinator'];
            foreach ($suspiciousDomains as $domain) {
                if (strpos($emailDomain, $domain) !== false) {
                    $score += 2;
                    break;
                }
            }
        }
        
        return $score;
    }

    /**
     * Check for malicious content
     */
    private function containsMaliciousContent(Request $request)
    {
        $content = strtolower($request->name . ' ' . $request->subject . ' ' . $request->message);
        
        // Malicious patterns
        $maliciousPatterns = [
            '/<script[^>]*>.*?<\/script>/i',
            '/javascript:/i',
            '/on\w+\s*=/i',
            '/<iframe[^>]*>.*?<\/iframe>/i',
            '/<object[^>]*>.*?<\/object>/i',
            '/<embed[^>]*>/i',
            '/<link[^>]*>/i',
            '/<meta[^>]*>/i',
            '/<style[^>]*>.*?<\/style>/i',
            '/<form[^>]*>.*?<\/form>/i',
            '/<input[^>]*>/i',
            '/<textarea[^>]*>.*?<\/textarea>/i',
            '/<select[^>]*>.*?<\/select>/i',
            '/<button[^>]*>.*?<\/button>/i',
            '/<a[^>]*>.*?<\/a>/i',
            '/<img[^>]*>/i',
            '/<video[^>]*>.*?<\/video>/i',
            '/<audio[^>]*>.*?<\/audio>/i',
            '/<source[^>]*>/i',
            '/<track[^>]*>/i',
            '/<canvas[^>]*>.*?<\/canvas>/i',
            '/<svg[^>]*>.*?<\/svg>/i',
            '/<math[^>]*>.*?<\/math>/i',
            '/<table[^>]*>.*?<\/table>/i',
            '/<tr[^>]*>.*?<\/tr>/i',
            '/<td[^>]*>.*?<\/td>/i',
            '/<th[^>]*>.*?<\/th>/i',
            '/<thead[^>]*>.*?<\/thead>/i',
            '/<tbody[^>]*>.*?<\/tbody>/i',
            '/<tfoot[^>]*>.*?<\/tfoot>/i',
            '/<col[^>]*>/i',
            '/<colgroup[^>]*>.*?<\/colgroup>/i',
            '/<caption[^>]*>.*?<\/caption>/i',
            '/<thead[^>]*>.*?<\/thead>/i',
            '/<tbody[^>]*>.*?<\/tbody>/i',
            '/<tfoot[^>]*>.*?<\/tfoot>/i',
            '/<col[^>]*>/i',
            '/<colgroup[^>]*>.*?<\/colgroup>/i',
            '/<caption[^>]*>.*?<\/caption>/i'
        ];
        
        foreach ($maliciousPatterns as $pattern) {
            if (preg_match($pattern, $content)) {
                return true;
            }
        }
        
        // Check for SQL injection patterns
        $sqlPatterns = [
            '/union\s+select/i',
            '/drop\s+table/i',
            '/delete\s+from/i',
            '/insert\s+into/i',
            '/update\s+set/i',
            '/alter\s+table/i',
            '/create\s+table/i',
            '/exec\s*\(/i',
            '/execute\s*\(/i',
            '/sp_/i',
            '/xp_/i',
            '/0x[0-9a-f]+/i',
            '/\'[\s]*or[\s]*\'/i',
            '/\"[\s]*or[\s]*\"/i',
            '/\'[\s]*and[\s]*\'/i',
            '/\"[\s]*and[\s]*\"/i'
        ];
        
        foreach ($sqlPatterns as $pattern) {
            if (preg_match($pattern, $content)) {
                return true;
            }
        }
        
        // Check for XSS patterns
        $xssPatterns = [
            '/<script/i',
            '/javascript:/i',
            '/vbscript:/i',
            '/onload=/i',
            '/onerror=/i',
            '/onclick=/i',
            '/onmouseover=/i',
            '/onfocus=/i',
            '/onblur=/i',
            '/onchange=/i',
            '/onsubmit=/i',
            '/onreset=/i',
            '/onselect=/i',
            '/onkeydown=/i',
            '/onkeyup=/i',
            '/onkeypress=/i',
            '/onmousedown=/i',
            '/onmouseup=/i',
            '/onmousemove=/i',
            '/onmouseout=/i',
            '/ondblclick=/i',
            '/oncontextmenu=/i',
            '/onabort=/i',
            '/oncanplay=/i',
            '/oncanplaythrough=/i',
            '/ondurationchange=/i',
            '/onemptied=/i',
            '/onended=/i',
            '/onerror=/i',
            '/onloadeddata=/i',
            '/onloadedmetadata=/i',
            '/onloadstart=/i',
            '/onpause=/i',
            '/onplay=/i',
            '/onplaying=/i',
            '/onprogress=/i',
            '/onratechange=/i',
            '/onseeked=/i',
            '/onseeking=/i',
            '/onstalled=/i',
            '/onsuspend=/i',
            '/ontimeupdate=/i',
            '/onvolumechange=/i',
            '/onwaiting=/i'
        ];
        
        foreach ($xssPatterns as $pattern) {
            if (preg_match($pattern, $content)) {
                return true;
            }
        }
        
        return false;
    }
}
