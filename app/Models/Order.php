<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    public const STATUSES = ['pending', 'preparing', 'out_for_delivery', 'completed', 'cancelled'];
    public const PAYMENT_METHODS = ['cod', 'paymaya', 'gcash', 'credits'];

    private const STATUS_TRANSITIONS = [
        'pending' => ['pending', 'preparing', 'cancelled'],
        'preparing' => ['preparing', 'out_for_delivery', 'cancelled'],
        'out_for_delivery' => ['out_for_delivery', 'completed', 'cancelled'],
        'completed' => ['completed'],
        'cancelled' => ['cancelled'],
    ];

    private const PAYMENT_STATUS_TRANSITIONS = [
        'unpaid' => ['unpaid', 'paid'],
        'paid' => ['paid', 'refunded'],
        'refunded' => ['refunded'],
    ];

    protected $fillable = [
        'order_number', 'user_id', 'customer_name', 'address', 'phone',
        'delivery_latitude', 'delivery_longitude', 'payment_method', 'payment_status', 'status', 'subtotal', 'total', 'notes',
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'total' => 'decimal:2',
        'delivery_latitude' => 'decimal:7',
        'delivery_longitude' => 'decimal:7',
    ];

    public static function generateNumber(): string
    {
        do {
            $number = 'ZC-' . now()->format('ymd') . '-' . strtoupper(Str::random(5));
        } while (static::where('order_number', $number)->exists());

        return $number;
    }

    public function canTransitionTo(string $status): bool
    {
        return in_array($status, self::STATUS_TRANSITIONS[$this->status] ?? [], true);
    }

    public function canTransitionPaymentTo(string $status): bool
    {
        return in_array($status, self::PAYMENT_STATUS_TRANSITIONS[$this->payment_status] ?? [], true);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
