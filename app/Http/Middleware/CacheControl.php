<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
            return $response->header('Cache-Control', 'public, max-age=3600, must-revalidate')
                           ->header('X-Content-Type-Options', 'nosniff')
                           ->header('X-Frame-Options', 'SAMEORIGIN')
                           ->header('X-XSS-Protection', '1; mode=block');
        }

        return $response;
    }
}

