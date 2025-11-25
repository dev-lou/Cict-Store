<?php

namespace App\Models;

use App\Traits\AuditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BuyListItem extends Model
{
    use HasFactory, AuditableTrait;

    protected $table = 'buy_list_items';

    protected $fillable = [
        'item_name',
        'quantity',
        'estimated_price_min',
        'estimated_price_max',
        'priority',
        'is_bought',
        'notes',
        'reason',
        'supplier_id',
        'status',
        'receipt_file_path',
        'estimated_cost',
        'actual_cost',
        'purchased_at',
        'custom_fields',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'estimated_price_min' => 'decimal:2',
        'estimated_price_max' => 'decimal:2',
        'is_bought' => 'boolean',
        'estimated_cost' => 'decimal:2',
        'actual_cost' => 'decimal:2',
        'purchased_at' => 'datetime',
        'custom_fields' => 'array',
    ];

    /**
     * Get the supplier for this buy list item.
     */
    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Scope to get pending items.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope to get high priority items.
     */
    public function scopeHighPriority($query)
    {
        return $query->where('priority', 'high')->orWhere('priority', 'urgent');
    }
}
