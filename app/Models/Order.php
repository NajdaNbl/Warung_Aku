<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_phone',
        'total_price',
        'total_items',
        'notes',
        'status',
    ];

    protected $casts = [
        'total_price' => 'decimal:2',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalPriceFormattedAttribute(): string
    {
        return 'Rp' . number_format($this->total_price, 0, ',', '.');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
