<?php

namespace App\Http\Middleware;

use App\Models\FailedLoginAttempt;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockFailedLogins
{
    /**
     * Handle an incoming request and check if IP is blocked
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Allow viewing login/register pages; only block credential submission attempts.
        if (!$request->isMethod('post') || !$request->routeIs('login.post')) {
            return $next($request);
        }

        $ipAddress = $request->ip();
        $email = (string) $request->input('email', '');

        // Check if IP is blocked
        if (FailedLoginAttempt::isBlocked($ipAddress, $email)) {
            $blockedUntil = FailedLoginAttempt::getBlockedUntil($ipAddress, $email);
            $minutesLeft = $blockedUntil ? now()->diffInMinutes($blockedUntil) : 30;

            return response()->view('errors.blocked', [
                'minutesLeft' => $minutesLeft,
                'blockedUntil' => $blockedUntil,
            ], 429);
        }

        return $next($request);
    }
}
