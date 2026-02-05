<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderVendor extends Model
{
    protected $fillable = [
        'order_id','vendor_id','vendor_total','status'
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class, 'vendor_id', 'vendor_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
