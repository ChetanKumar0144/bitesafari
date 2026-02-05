<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;

class Order extends Model
{
    protected $fillable = [
        'order_no',
        'customer_id',
        'total_amount',
        'status',
        'label',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country'
    ];

    /**
     * Order belongs to a customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Order items
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->belongsTo(CustomerAddress::class, 'address_id');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function vendors()
    {
        return $this->hasMany(OrderVendor::class);
    }

}
