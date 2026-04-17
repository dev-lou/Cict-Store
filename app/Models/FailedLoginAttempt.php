<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FailedLoginAttempt extends Model
{
    private const ATTEMPT_WINDOW_MINUTES = 30;

    protected $fillable = [
        'ip_address',
        'email',
        'user_agent',
        'attempted_at',
        'blocked_until',
    ];

    protected $casts = [
        'attempted_at' => 'datetime',
        'blocked_until' => 'datetime',
    ];

    /**
     * Check if an IP is currently blocked
     */
    public static function isBlocked(string $ipAddress, ?string $email = null): bool
    {
        $query = self::where('ip_address', $ipAddress)
            ->where('blocked_until', '>', now());

        if (!empty($email)) {
            $query->where('email', strtolower(trim($email)));
        }

        return $query->exists();
    }

    /**
     * Get remaining block time in minutes
     */
    public static function getBlockedUntil(string $ipAddress, ?string $email = null): ?Carbon
    {
        $query = self::where('ip_address', $ipAddress)
            ->where('blocked_until', '>', now());

        if (!empty($email)) {
            $query->where('email', strtolower(trim($email)));
        }

        $attempt = $query->orderBy('blocked_until', 'desc')->first();

        return $attempt?->blocked_until;
    }

    /**
     * Record a failed login attempt
     */
    public static function recordAttempt(string $ipAddress, ?string $email = null, ?string $userAgent = null): void
    {
        $normalizedEmail = $email ? strtolower(trim($email)) : null;

        self::create([
            'ip_address' => $ipAddress,
            'email' => $normalizedEmail,
            'user_agent' => $userAgent,
            'attempted_at' => now(),
        ]);

        // Progressive lockout by IP + email to avoid blocking whole shared networks.
        $attemptQuery = self::where('ip_address', $ipAddress)
            ->where('attempted_at', '>', now()->subMinutes(self::ATTEMPT_WINDOW_MINUTES));

        if (!empty($normalizedEmail)) {
            $attemptQuery->where('email', $normalizedEmail);
        }

        $recentAttempts = $attemptQuery->count();

        $blockMinutes = null;
        if ($recentAttempts >= 15) {
            $blockMinutes = 60;
        } elseif ($recentAttempts >= 10) {
            $blockMinutes = 15;
        } elseif ($recentAttempts >= 6) {
            $blockMinutes = 5;
        }

        if ($blockMinutes) {
            $blockQuery = self::where('ip_address', $ipAddress)
                ->where('attempted_at', '>', now()->subMinutes(self::ATTEMPT_WINDOW_MINUTES));

            if (!empty($normalizedEmail)) {
                $blockQuery->where('email', $normalizedEmail);
            }

            $blockQuery->update([
                'blocked_until' => now()->addMinutes($blockMinutes)
            ]);
        }
    }

    /**
     * Clear successful login attempts for an IP
     */
    public static function clearAttempts(string $ipAddress, ?string $email = null): void
    {
        $query = self::where('ip_address', $ipAddress);

        if (!empty($email)) {
            $query->where('email', strtolower(trim($email)));
        }

        $query->delete();
    }

    /**
     * Clean up old records (older than 7 days)
     */
    public static function cleanup(): void
    {
        self::where('attempted_at', '<', now()->subDays(7))->delete();
    }
}
