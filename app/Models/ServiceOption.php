<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\AuditableTrait;

class ServiceOption extends Model
{
    use HasFactory, AuditableTrait;

    protected $fillable = [
        'service_id',
        'name',
        'dimensions',
        'price_primary',
        'price_secondary',
        'price_primary_label',
        'price_secondary_label',
        'size_class',
        'badge',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'price_primary' => 'decimal:2',
        'price_secondary' => 'decimal:2',
    ];

    /**
     * Get the service this option belongs to.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Scope for active options.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', '=', true);
    }

    /**
     * Scope for ordering.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('created_at');
    }
}
