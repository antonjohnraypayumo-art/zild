<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $fillable = ['token', 'user_id'];

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /** Cart contents with live prices (product price + size modifier). */
    public function summary(): array
    {
        $items = $this->items()->with(['product', 'size'])->get()->map(function (CartItem $item) {
            $unit = (float) $item->product->price + (float) ($item->size->price_modifier ?? 0);

            return [
                'id' => $item->id,
                'product_id' => $item->product_id,
                'name' => $item->product->name,
                'image_url' => $item->product->image_url,
                'product_size_id' => $item->product_size_id,
                'size' => $item->size?->name,
                'unit_price' => round($unit, 2),
                'quantity' => $item->quantity,
                'line_total' => round($unit * $item->quantity, 2),
                'is_available' => $item->product->is_available,
            ];
        })->values();

        $total = round($items->sum('line_total'), 2);

        return [
            'token' => $this->token,
            'items' => $items,
            'item_count' => $items->sum('quantity'),
            'subtotal' => $total,
            'total' => $total,
        ];
    }
}
