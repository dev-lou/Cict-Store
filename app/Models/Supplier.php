<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'contact_person',
        'email',
        'phone',
        'address',
        'status',
        'is_preferred',
    ];

    protected $casts = [
        'is_preferred' => 'boolean',
    ];

    /**
     * Get the products from this supplier.
     */
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get the buy list items for this supplier.
     */
    public function buyListItems(): HasMany
    {
        return $this->hasMany(BuyListItem::class);
    }

    /**
     * Scope to get only active suppliers.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope to get preferred suppliers.
     */
    public function scopePreferred($query)
    {
        return $query->where('is_preferred', true);
    }
}
