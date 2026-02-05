<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'subtotal',
        'gst_amount',
        'delivery_charge',
        'tip_amount',
        'total_amount',
        'payment_method',
        'payment_status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}

