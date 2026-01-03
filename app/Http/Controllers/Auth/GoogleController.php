<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\InvalidStateException;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle(Request $request)
    {
        // Get intended URL from redirect parameter, referrer, or current URL
        $intendedUrl = $request->get('redirect');
        
        if (!$intendedUrl) {
            $intendedUrl = $request->headers->get('referer') ?: url()->current();
        }
        
        // Decode URL if it's encoded
        if ($intendedUrl) {
            $intendedUrl = urldecode($intendedUrl);
        }
        
        // Validate and clean the intended URL
        // Allow CMS routes and other valid routes, only reject auth/logout routes
        if (!$intendedUrl || 
            $intendedUrl === route('auth.google') || 
            str_contains($intendedUrl, 'auth/google') ||
            str_contains($intendedUrl, 'logout') ||
            str_contains($intendedUrl, '/auth/google/callback')) {
            $intendedUrl = route('home');
        }
        
        // Ensure URL is absolute (full URL)
        if ($intendedUrl && !str_starts_with($intendedUrl, 'http')) {
            $intendedUrl = url($intendedUrl);
        }

        // Save intended URL in session before redirecting to Google
        session(['url.intended' => $intendedUrl]);
        session()->save(); // Ensure session is saved

        // Use stateless mode to avoid session state issues
        $redirect = Socialite::driver('google')->stateless()->redirect();
        
        // Also store in cookie as backup (in case session is lost during OAuth)
        // Cookie will expire in 10 minutes (enough time for OAuth flow)
        return $redirect->cookie('intended_url', $intendedUrl, 10);
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback(Request $request)
    {
        // Prevent redirect loops by checking if we're already processing a callback
        if (!$request->has('code')) {
            return redirect()->route('home')
                ->with('error', 'Invalid OAuth callback. Please try logging in again.')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        }

        try {
            // Use stateless mode to avoid session state issues
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if user already exists
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // If email_verified_at is null, update it
                if (is_null($user->email_verified_at)) {
                    $user->email_verified_at = now();
                    $user->save();
                }
            } else {
                // Create new user
                $user = User::create([
                    'name'              => $googleUser->getName(),
                    'email'             => $googleUser->getEmail(),
                    'password'          => bcrypt(Str::random(16)), // Random password since they'll use Google
                ]);
                
                // Set email_verified_at after creation since it's not in fillable
                $user->email_verified_at = now(); // Google emails are already verified
                $user->save();
            }

            // Get intended URL BEFORE login (to preserve it)
            // Try session first, then cookie as fallback
            $intendedUrl = session()->get('url.intended');
            
            // If not in session, try cookie (backup for stateless OAuth)
            if (!$intendedUrl) {
                $intendedUrl = $request->cookie('intended_url');
            }
            
            // Clean up intended URL from session and cookie
            session()->forget('url.intended');
            
            // If no intended URL, default to home
            if (!$intendedUrl) {
                $intendedUrl = route('home');
            }
            
            // Validate intended URL - allow CMS routes and other valid routes
            // Only reject auth/logout routes
            if ($intendedUrl === route('auth.google') || 
                str_contains($intendedUrl, 'auth/google') ||
                str_contains($intendedUrl, '/auth/google/callback')) {
                $intendedUrl = route('home');
            }
            
            // Ensure URL is absolute
            if ($intendedUrl && !str_starts_with($intendedUrl, 'http')) {
                $intendedUrl = url($intendedUrl);
            }

            // Login user with remember me
            Auth::login($user, true);
            
            // Regenerate session for security
            $request->session()->regenerate();
            
            // Ensure session is saved
            $request->session()->save();
            
            // Add parameter to trigger UI update
            $separator = strpos($intendedUrl, '?') !== false ? '&' : '?';
            $intendedUrl .= $separator . 'logged_in=1';
            
            // Redirect with success message and no-cache headers
            // Also clear the backup cookie
            return redirect($intendedUrl)
                ->with('success', 'Successfully logged in with Google!')
                ->cookie('intended_url', '', -1) // Delete cookie
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');

        } catch (InvalidStateException $e) {
            Log::warning('Google OAuth InvalidStateException: ' . $e->getMessage());
            
            return redirect()->route('home')
                ->with('error', 'OAuth session expired. Please try logging in with Google again.')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
                
        } catch (\Exception $e) {
            Log::error('Google login failed: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('home')
                ->with('error', 'Google login failed. Please try again.')
                ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                ->header('Pragma', 'no-cache')
                ->header('Expires', '0');
        }
    }
}
