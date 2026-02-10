<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Aapne sirf 'name' rakha tha, lekin slug aur image CRUD ke liye zaroori hain
    protected $fillable = [
        'name',
        'slug',
        'image',
        'status'
    ];

    public function getImagePathAttribute()
    {
        return $this->image ? asset($this->image) : asset('assets/default-category.png');
    }

    protected $appends = ['image_path'];

    /**
     * Category belongs to many foods
     * Aapne ye relationship pehle hi set ki hai
     */
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
