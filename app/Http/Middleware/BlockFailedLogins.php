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
        $ipAddress = $request->ip();

        // Check if IP is blocked
        if (FailedLoginAttempt::isBlocked($ipAddress)) {
            $blockedUntil = FailedLoginAttempt::getBlockedUntil($ipAddress);
            $minutesLeft = $blockedUntil ? now()->diffInMinutes($blockedUntil) : 30;

            return response()->view('errors.blocked', [
                'minutesLeft' => $minutesLeft,
                'blockedUntil' => $blockedUntil,
            ], 429);
        }

        return $next($request);
    }
}
