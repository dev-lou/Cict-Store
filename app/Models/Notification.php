<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

/**
 * Notification Model
 *
 * @property int $id
 * @property int $user_id
 * @property string $type
 * @property string|null $notifiable_type
 * @property int|null $notifiable_id
 * @property array|null $data
 * @property bool $is_read
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class Notification extends Model
{
    use HasFactory;

    /**
     * Notifications use UUID identifiers in production DB.
     * Keep id as string to avoid coercion to integer 0.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * @var string
     */
    protected $keyType = 'string';

    protected $fillable = [
        'user_id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'data' => 'array',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    /**
     * Get the user that owns the notification.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mark notification as read.
     */
    public function markAsRead(): void
    {
        if (!$this->is_read) {
            $now = now();

            // Use SQL TRUE literal to stay compatible with PostgreSQL boolean typing.
            static::query()
                ->whereKey($this->getKey())
                ->update([
                    'is_read' => DB::raw('TRUE'),
                    'read_at' => $now,
                    'updated_at' => $now,
                ]);

            $this->is_read = true;
            $this->read_at = $now;
            $this->updated_at = $now;
        }
    }

    /**
     * Scope to get only unread notifications.
     */
    public function scopeUnread($query)
    {
        return $query->whereRaw('is_read IS FALSE');
    }

    /**
     * Scope to get only read notifications.
     */
    public function scopeRead($query)
    {
        return $query->whereRaw('is_read IS TRUE');
    }

    /**
     * Scope to get recent notifications.
     */
    public function scopeRecent($query, $days = 30)
    {
        return $query->where('created_at', '>=', now()->subDays($days));
    }
}
