<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'password',
        'is_active'
    ];

    protected $hidden = [
        'password',
    ];

    // optional but clean
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function foods()
    {
        return $this->hasMany(Food::class);
    }

    public function orders()
    {
        // Orders that include this vendor's items
        return $this->hasManyThrough(
            Order::class,       // Final model
            OrderItem::class,   // Intermediate model
            'vendor_id',        // Foreign key on OrderItem (points to vendor)
            'id',               // Foreign key on Order (primary key)
            'id',               // Local key on Vendor
            'order_id'          // Local key on OrderItem that points to Order
        )->distinct();         // Ensure unique orders
    }
}
