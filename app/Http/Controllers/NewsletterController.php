<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subscriber;
use App\Mail\SendOtpMail;
use Illuminate\Support\Facades\Mail;

class NewsletterController extends Controller
{
    /**
     * Handle the initial subscription request
     */
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email|max:255']);
        $email = $request->email;

        // --- ADDED: Check if the email is already subscribed and verified ---
        $isAlreadyVerified = Subscriber::where('email', $email)
                                       ->whereNotNull('email_verified_at')
                                       ->exists();

        if ($isAlreadyVerified) {
            // If they are, redirect back with a friendly info message.
            return back()->with('info', 'This email address is already subscribed to our newsletter.');
        }
        // --- END OF NEW CHECK ---

        // If the email is new or not yet verified, proceed with sending an OTP.
        $otp = rand(100000, 999999);
        session(['otp' => $otp, 'email_for_verification' => $email]);

        Mail::to($email)->send(new SendOtpMail($otp));

        return redirect()->route('newsletter.verify.form')
                         ->with('success', 'An OTP has been sent to your email. Please check your inbox.');
    }

    /**
     * Show the OTP verification form
     */
    public function showVerificationForm()
    {
        if (!session()->has('email_for_verification')) {
            return redirect()->route('home')->with('error', 'Session expired. Please try again.');
        }
        return view('newsletter.verify');
    }

    /**
     * Process the OTP and save the subscriber
     */
    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|numeric|digits:6']);

        $sessionOtp = session('otp');
        $sessionEmail = session('email_for_verification');

        if (!$sessionEmail || !$sessionOtp) {
            return redirect()->route('home')->with('error', 'Your session has expired. Please try again.');
        }

        if ($request->otp == $sessionOtp) {
            Subscriber::updateOrCreate(
                ['email' => $sessionEmail],
                ['email_verified_at' => now()]
            );

            session()->forget(['otp', 'email_for_verification']);

            return redirect()->route('home')->with('success', 'Thank you for subscribing to our newsletter!');
        } else {
            return back()->with('error', 'The OTP you entered is incorrect. Please try again.');
        }
    }
}