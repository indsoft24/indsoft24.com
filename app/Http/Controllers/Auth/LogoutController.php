<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        // Get redirect URL from request parameter or referrer
        $redirectUrl = $request->input('redirect');
        
        if (!$redirectUrl) {
            $redirectUrl = $request->headers->get('referer') ?: url()->previous();
        }
        
        // Validate redirect URL - don't redirect to logout or auth routes
        if (!$redirectUrl || 
            str_contains($redirectUrl, 'logout') || 
            str_contains($redirectUrl, 'auth/google') ||
            $redirectUrl === route('logout')) {
            $redirectUrl = route('home');
        }

        // Logout user
        Auth::logout();
        
        // Invalidate session
        $request->session()->invalidate();
        
        // Regenerate CSRF token
        $request->session()->regenerateToken();
        
        // Redirect back to previous page or home with no-cache headers
        return redirect($redirectUrl)
            ->with('success', 'Successfully logged out!')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate, private')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }
}

