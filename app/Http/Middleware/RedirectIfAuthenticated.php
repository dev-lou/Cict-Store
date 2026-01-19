<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                // Prevent redirect loops: if already on an admin or home page, don't redirect
                if ($request->is('admin/*') || $request->is('/')) {
                    return $next($request);
                }
                
                // Redirect admin users to admin dashboard, regular users to home
                if (Auth::user()->isAdmin()) {
                    return redirect('/admin/dashboard');
                }
                return redirect('/');
            }
        }

        return $next($request);
    }
}
