<?php

namespace App\Http\Controllers;

use App\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeadController extends Controller
{
    public function store(Request $request)
    {
        // Rate limiting check
        $key = 'lead_form_' . $request->ip();
        $attempts = \Cache::get($key, 0);
        
        if ($attempts >= 5) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Too many requests. Please try again later.',
                ], 429);
            }
            return redirect()->back()->with('error', 'Too many requests. Please try again later.');
        }

        // Honeypot check
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

        // Spam detection
        $spamScore = $this->calculateSpamScore($request);
        $isSpam = $spamScore > 3;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20|regex:/^[0-9\+\-\s\(\)]+$/',
            'company' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:500',
        ], [
            'name.regex' => 'Name can only contain letters and spaces.',
            'phone.regex' => 'Please enter a valid phone number.',
        ]);

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Please check your input and try again.',
                    'errors' => $validator->errors(),
                ], 422);
            }
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Save to database
        $lead = Lead::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'message' => $request->message,
            'source' => $request->source ?? 'homepage',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'is_spam' => $isSpam,
            'spam_score' => $spamScore,
        ]);

        // Increment rate limiting counter
        \Cache::put($key, $attempts + 1, 300); // 5 minutes

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Thank you! We will contact you soon.',
            ]);
        }

        return redirect()->back()->with('success', 'Thank you! We will contact you soon.');
    }

    /**
     * Calculate spam score
     */
    private function calculateSpamScore(Request $request)
    {
        $score = 0;
        $content = strtolower(($request->name ?? '') . ' ' . ($request->email ?? '') . ' ' . ($request->message ?? ''));
        
        // Spam keywords
        $spamKeywords = [
            'viagra', 'casino', 'lottery', 'winner', 'congratulations', 'free money',
            'click here', 'buy now', 'limited time', 'act now', 'urgent', 'guaranteed',
        ];
        
        foreach ($spamKeywords as $keyword) {
            if (strpos($content, $keyword) !== false) {
                $score += 2;
            }
        }
        
        return $score;
    }
}
