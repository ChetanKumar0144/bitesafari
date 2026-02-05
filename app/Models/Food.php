<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Food extends Model
{
    use SoftDeletes;
    protected $table = 'food';

    protected $fillable = [
        'name',
        'price',
        'description',
        'quantity',
        'image',
        'category_id',
        'vendor_id',
        'rating'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
