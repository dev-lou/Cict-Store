<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * User Model
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string|null $profile_picture
 * @property array<int, string> $roles
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'roles',
        'profile_picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'roles' => 'array',
    ];

    /**
     * Get the orders for this user (customer).
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    /**
     * Get the orders assigned to this user (staff).
     */
    public function assignedOrders(): HasMany
    {
        return $this->hasMany(Order::class, 'assigned_staff_id');
    }

    /**
     * Get the inventory history records created by this user.
     */
    public function inventoryHistoryRecords(): HasMany
    {
        return $this->hasMany(InventoryHistory::class, 'user_id');
    }

    /**
     * Get the notifications for this user.
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Get the reviews written by this user.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Check if user has a specific role.
     */
    public function hasRole($roles): bool
    {
        $roles = is_array($roles) ? $roles : [$roles];
        
        // Handle roles as either array or JSON string
        $userRoles = $this->roles;
        if (is_string($userRoles)) {
            $userRoles = json_decode($userRoles, true) ?? [];
        }
        
        return count(array_intersect($userRoles ?? [], $roles)) > 0;
    }

    /**
     * Check if user is an admin.
     */
    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    /**
     * Check if user is staff.
     */
    public function isStaff(): bool
    {
        return $this->hasRole(['admin', 'staff']);
    }
}
