<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->guest(route('login'));
        }

        // Check if user has admin role
        if (!auth()->user()->isAdmin()) {
            // Non-admin users should be redirected to home, not given 403
            return redirect('/')->with('error', 'You do not have permission to access the admin area.');
        }

        return $next($request);
    }
}
