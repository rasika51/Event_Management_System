<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Remove security headers that might cause browser warnings
        $response->headers->remove('X-Frame-Options');
        $response->headers->remove('X-Content-Type-Options');
        $response->headers->remove('X-XSS-Protection');
        $response->headers->remove('Strict-Transport-Security');
        $response->headers->remove('Content-Security-Policy');
        $response->headers->remove('Referrer-Policy');
        $response->headers->remove('Permissions-Policy');

        // Set permissive headers to avoid security warnings
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-XSS-Protection', '0');
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');

        return $response;
    }
}
