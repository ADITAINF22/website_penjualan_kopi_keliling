<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['customer_name', 'phone', 'address', 'note', 'total', 'status', 'channel'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function recalcTotal(): void
    {
        $this->update([
            'total' => $this->items()->selectRaw('COALESCE(SUM(price * quantity), 0) as t')->value('t'),
        ]);
    }
}
