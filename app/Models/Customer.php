<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, Notifiable;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'otp',
        'otp_expiry',
    ];

    protected $hidden = [
        'otp',
    ];

    /**
     * Orders for this customer
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }
}
