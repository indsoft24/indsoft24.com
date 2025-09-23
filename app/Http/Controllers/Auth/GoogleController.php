<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        $previousUrl = url()->previous();

        // Prevent saving OAuth routes as intended (to avoid redirect loops)
        if (!str_contains($previousUrl, 'auth/google')) {
            session(['url.intended' => $previousUrl]);
        }

        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Check if user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // If email_verified_at is null, update it
                if (is_null($user->email_verified_at)) {
                    $user->email_verified_at = now();
                    $user->save();
                }

                Auth::login($user);
            } else {
                // Create new user
                $user = User::create([
                    'name'              => $googleUser->getName(),
                    'email'             => $googleUser->getEmail(),
                    'password'          => bcrypt(Str::random(16)), // Random password since they'll use Google
                    'email_verified_at' => now(), // Google emails are already verified
                ]);

                Auth::login($user);
            }

            // Redirect to intended URL (or home as fallback)
            return redirect()->intended(route('home'))
                ->with('success', 'Successfully logged in with Google!');

        } catch (\Exception $e) {
            return redirect()->route('home')
                ->with('error', 'Google login failed. Please try again.');
        }
    }
}
