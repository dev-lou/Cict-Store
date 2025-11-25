<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InventoryHistory extends Model
{
    use HasFactory;

    protected $table = 'inventory_history';

    protected $fillable = [
        'product_id',
        'variant_id',
        'user_id',
        'type',
        'quantity_changed',
        'quantity_before',
        'quantity_after',
        'reference',
        'notes',
    ];

    protected $casts = [
        'quantity_changed' => 'integer',
        'quantity_before' => 'integer',
        'quantity_after' => 'integer',
    ];

    /**
     * Get the product for this history record.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the variant for this history record.
     */
    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class);
    }

    /**
     * Get the user who made the change.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope to get stock-in transactions.
     */
    public function scopeStockIn($query)
    {
        return $query->where('type', 'stock_in');
    }

    /**
     * Scope to get stock-out transactions.
     */
    public function scopeStockOut($query)
    {
        return $query->where('type', 'stock_out');
    }
}
