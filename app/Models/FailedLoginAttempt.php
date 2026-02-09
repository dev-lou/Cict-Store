<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FailedLoginAttempt extends Model
{
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
    public static function isBlocked(string $ipAddress): bool
    {
        return self::where('ip_address', $ipAddress)
            ->where('blocked_until', '>', now())
            ->exists();
    }

    /**
     * Get remaining block time in minutes
     */
    public static function getBlockedUntil(string $ipAddress): ?Carbon
    {
        $attempt = self::where('ip_address', $ipAddress)
            ->where('blocked_until', '>', now())
            ->orderBy('blocked_until', 'desc')
            ->first();

        return $attempt?->blocked_until;
    }

    /**
     * Record a failed login attempt
     */
    public static function recordAttempt(string $ipAddress, ?string $email = null, ?string $userAgent = null): void
    {
        self::create([
            'ip_address' => $ipAddress,
            'email' => $email,
            'user_agent' => $userAgent,
            'attempted_at' => now(),
        ]);

        // Check if we should block this IP
        $recentAttempts = self::where('ip_address', $ipAddress)
            ->where('attempted_at', '>', now()->subMinutes(30))
            ->count();

        // Block after 10 failed attempts in 30 minutes
        if ($recentAttempts >= 10) {
            self::where('ip_address', $ipAddress)
                ->where('attempted_at', '>', now()->subMinutes(30))
                ->update([
                    'blocked_until' => now()->addMinutes(30)
                ]);
        }
    }

    /**
     * Clear successful login attempts for an IP
     */
    public static function clearAttempts(string $ipAddress): void
    {
        self::where('ip_address', $ipAddress)
            ->whereNull('blocked_until')
            ->delete();
    }

    /**
     * Clean up old records (older than 7 days)
     */
    public static function cleanup(): void
    {
        self::where('attempted_at', '<', now()->subDays(7))->delete();
    }
}
