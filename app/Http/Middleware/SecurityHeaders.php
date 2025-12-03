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

        // Force HTTPS in production
        if (!$request->secure() && app()->environment('production')) {
            return redirect()->secure($request->getRequestUri(), 301);
        }

        // ===== SECURITY HEADERS =====
        
        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        
        // Clickjacking protection
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        
        // XSS Protection (legacy, but still useful)
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        // Referrer Policy - strict for security
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Content Security Policy (CSP) - Prevent XSS and injection attacks
        $csp = "default-src 'self'; " .
               "script-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; " .
               "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; " .
               "img-src 'self' data: https:; " .
               "font-src 'self' https://cdn.jsdelivr.net https://cdnjs.cloudflare.com; " .
               "connect-src 'self' https://cdn.jsdelivr.net; " .
               "frame-ancestors 'self'; " .
               "base-uri 'self'; " .
               "form-action 'self'";
        $response->headers->set('Content-Security-Policy', $csp);
        
        // HTTP Strict Transport Security (HSTS) - Force HTTPS
        // Uncomment in production when HTTPS is enabled
        if (app()->environment('production')) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains; preload');
        }
        
        // Cross-Origin-Opener-Policy (COOP) - Isolate window context
        $response->headers->set('Cross-Origin-Opener-Policy', 'same-origin');
        
        // Cross-Origin-Resource-Policy (CORP) - Control resource access
        $response->headers->set('Cross-Origin-Resource-Policy', 'same-origin');
        
        // Trusted-Types - Prevent DOM-based XSS
        $response->headers->set('Trusted-Types', "default 'allow-duplicates'");
        
        // Permissions-Policy - Control browser features
        $response->headers->set('Permissions-Policy', 
            'geolocation=(), ' .
            'microphone=(), ' .
            'camera=(), ' .
            'payment=(), ' .
            'usb=(), ' .
            'magnetometer=(), ' .
            'gyroscope=(), ' .
            'accelerometer=()'
        );
        
        // ===== CACHE CONTROL HEADERS =====
        
        if ($this->isStaticAsset($request)) {
            // Images: 1 year (immutable)
            if (preg_match('/\.(jpg|jpeg|png|gif|webp|svg|ico)$/i', $request->path())) {
                $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
            }
            // Fonts: 1 year (immutable)
            elseif (preg_match('/\.(woff|woff2|ttf|eot)$/i', $request->path())) {
                $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
                $response->headers->set('Access-Control-Allow-Origin', '*');
            }
            // CSS/JS: 1 month
            else {
                $response->headers->set('Cache-Control', 'public, max-age=2592000');
            }
        } else {
            // HTML: no cache (always fresh)
            $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
        }
        
        // ===== PERFORMANCE HEADERS =====
        
        // Enable compression
        $response->headers->set('Vary', 'Accept-Encoding');

        return $response;
    }

    private function isStaticAsset($request)
    {
        $path = $request->path();
        // Also check if path contains 'assets' directory
        return preg_match('/\.(css|js|png|jpg|jpeg|gif|webp|svg|woff|woff2|ttf|ico)$/i', $path) || 
               strpos($path, 'assets') !== false;
    }
}
