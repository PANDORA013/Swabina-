<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     * Add security and performance headers for SEO optimization
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Force HTTPS
        if (!$request->secure() && app()->environment('production')) {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        // Security Headers
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'DENY');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Performance Headers for SEO
        if ($this->isStaticAsset($request)) {
            // Cache static assets for 30 days (versioned files)
            $response->headers->set('Cache-Control', 'public, max-age=2592000, immutable');
            $response->headers->set('Expires', gmdate('D, d M Y H:i:s \G\M\T', time() + 2592000));
        } else {
            // Cache HTML pages for 1 hour
            $response->headers->set('Cache-Control', 'public, max-age=3600');
        }
        
        // Enable gzip compression
        $response->headers->set('Vary', 'Accept-Encoding');

        // Compression
        if (!$response->headers->has('Content-Encoding')) {
            $response->headers->set('Vary', 'Accept-Encoding');
        }

        return $response;
    }

    private function isStaticAsset($request)
    {
        $path = $request->path();
        return preg_match('/\.(css|js|png|jpg|jpeg|gif|webp|svg|woff|woff2|ttf|ico)$/i', $path);
    }
}
