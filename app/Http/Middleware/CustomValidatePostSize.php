<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomValidatePostSize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the maximum post size from PHP configuration
        $maxSize = $this->getPostMaxSize();
        
        // For PDF tool routes, allow up to 100MB
        if ($request->is('tools/pdf-compress/*') || $request->is('tools/pdf-unlock/*') || $request->is('tools/pdf-lock/*')) {
            $maxSize = 100 * 1024 * 1024; // 100MB in bytes
        }

        $contentLength = $request->server('CONTENT_LENGTH');
        
        // Check if content length exceeds limit
        if ($contentLength && (int)$contentLength > $maxSize) {
            return response()->json([
                'success' => false,
                'message' => 'The uploaded file exceeds the maximum allowed size of ' . $this->formatBytes($maxSize) . '.',
            ], 413);
        }

        return $next($request);
    }

    /**
     * Get the maximum post size in bytes
     */
    private function getPostMaxSize(): int
    {
        $postMaxSize = ini_get('post_max_size');
        return $this->convertToBytes($postMaxSize);
    }

    /**
     * Convert PHP size string to bytes
     */
    private function convertToBytes(string $size): int
    {
        $size = trim($size);
        $last = strtolower($size[strlen($size) - 1]);
        $size = (int) $size;

        switch ($last) {
            case 'g':
                $size *= 1024;
                // no break
            case 'm':
                $size *= 1024;
                // no break
            case 'k':
                $size *= 1024;
        }

        return $size;
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes(int $bytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= (1 << (10 * $pow));

        return round($bytes, 2) . ' ' . $units[$pow];
    }
}

