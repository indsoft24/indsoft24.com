<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\EmailVerificationMail;

class EmailVerificationController extends Controller
{
    /**
     * Show email verification notice
     */
    public function notice()
    {
        if (Auth::check() && Auth::user()->isEmailVerified()) {
            return redirect()->route('home')->with('success', 'Your email is already verified!');
        }

        return view('auth.verify-email');
    }

    /**
     * Verify email with token
     */
    public function verify(Request $request, $token)
    {
        $user = User::where('email_verification_token', $token)->first();

        if (!$user) {
            return redirect()->route('verification.notice')
                ->with('error', 'Invalid verification token.');
        }

        if ($user->verifyEmail($token)) {
            Auth::login($user);
            return redirect()->route('home')
                ->with('success', 'Your email has been successfully verified!');
        }

        return redirect()->route('verification.notice')
            ->with('error', 'Verification token has expired. Please request a new one.');
    }

    /**
     * Resend verification email
     */
    public function resend(Request $request)
    {
        $user = Auth::user();

        if ($user->isEmailVerified()) {
            return redirect()->route('home')
                ->with('success', 'Your email is already verified!');
        }

        // Generate new token
        $token = $user->generateEmailVerificationToken();

        // Send verification email
        Mail::to($user->email)->send(new EmailVerificationMail($user, $token));

        return back()->with('success', 'Verification email sent! Please check your inbox.');
    }

    /**
     * Show verification success page
     */
    public function success()
    {
        return view('auth.verification-success');
    }

    /**
     * Show verification error page
     */
    public function error()
    {
        return view('auth.verification-error');
    }
}