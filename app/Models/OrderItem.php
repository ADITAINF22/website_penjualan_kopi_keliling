<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'product_name', 'price', 'quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    protected static function booted(): void
    {
        static::saved(fn(self $item) => $item->order?->recalcTotal());
        static::deleted(fn(self $item) => $item->order?->recalcTotal());
    }
}
