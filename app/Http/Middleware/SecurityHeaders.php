<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request and add security headers
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $isAuthPage = $request->routeIs('login', 'login.post', 'register', 'register.post');

        // Prevent clickjacking attacks
        $response->headers->set('X-Frame-Options', $isAuthPage ? 'DENY' : 'SAMEORIGIN');

        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // Enable XSS filter in browsers
        $response->headers->set('X-XSS-Protection', '1; mode=block');

        // Enforce HTTPS
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');

        // Content Security Policy (basic, adjust as needed)
        $csp =
            "default-src 'self'; ".
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' http://localhost:5173 https://cdn.jsdelivr.net https://cdnjs.cloudflare.com https://unpkg.com https://www.googletagmanager.com https://generativelanguage.googleapis.com https://maps.googleapis.com; ".
            "style-src 'self' 'unsafe-inline' http://localhost:5173 https://fonts.googleapis.com https://cdn.jsdelivr.net; ".
            "style-src-elem 'self' 'unsafe-inline' http://localhost:5173 https://fonts.googleapis.com https://cdn.jsdelivr.net; ".
            "font-src 'self' http://localhost:5173 https://fonts.gstatic.com data:; ".
            "img-src 'self' data: https: blob: https://*.supabase.co https://*.googleapis.com https://*.gstatic.com; ".
            "frame-src 'self' https://www.google.com https://maps.google.com https://*.google.com; ".
            "connect-src 'self' http://localhost:5173 ws://localhost:5173 https://generativelanguage.googleapis.com https://*.supabase.co https://maps.googleapis.com; ".
            'frame-ancestors '.($isAuthPage ? "'none'" : "'self'").';';

        $response->headers->set('Content-Security-Policy', $csp);

        // Referrer Policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions Policy (formerly Feature Policy)
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        if ($isAuthPage) {
            // Prevent browsers/proxies from caching auth pages.
            $response->headers->set('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0, private');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');
            $response->headers->set('X-Robots-Tag', 'noindex, nofollow, noarchive');
        }

        return $response;
    }
}
