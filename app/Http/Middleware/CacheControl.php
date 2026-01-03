<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CacheControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Set cache headers for static assets
        if ($request->is('css/*') || $request->is('js/*') || $request->is('images/*')) {
            return $response->header('Cache-Control', 'public, max-age=31536000, immutable')
                           ->header('Expires', gmdate('D, d M Y H:i:s', time() + 31536000) . ' GMT');
        }

        // Set cache headers for HTML pages
        if ($response->headers->get('Content-Type') && str_contains($response->headers->get('Content-Type'), 'text/html')) {
            // ALWAYS prevent caching for authenticated users on ALL pages
            // Also prevent caching for pages with auth-related parameters
            // CMS pages should always check auth state to prevent caching issues
            $isCmsRoute = $request->is('cms/*');
            $isAuthenticated = Auth::check();
            $hasAuthParams = $request->has('logged_in') || $request->has('logout');
            $hasSession = session()->has('_token');
            
            if ($isAuthenticated || $hasAuthParams || $hasSession || $isCmsRoute) {
                // For CMS routes or authenticated users, always prevent caching
                // This ensures auth state is always fresh on CMS pages
                return $response->header('Cache-Control', 'no-cache, no-store, must-revalidate, private, max-age=0')
                               ->header('Pragma', 'no-cache')
                               ->header('Expires', '0')
                               ->header('X-Content-Type-Options', 'nosniff')
                               ->header('X-Frame-Options', 'SAMEORIGIN')
                               ->header('X-XSS-Protection', '1; mode=block')
                               ->header('Vary', 'Cookie, Authorization');
            }
            
            // Regular cache headers for non-authenticated, non-CMS pages
            return $response->header('Cache-Control', 'public, max-age=3600, must-revalidate')
                           ->header('X-Content-Type-Options', 'nosniff')
                           ->header('X-Frame-Options', 'SAMEORIGIN')
                           ->header('X-XSS-Protection', '1; mode=block');
        }

        return $response;
    }
}

