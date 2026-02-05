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

    /**
     * Category belongs to many foods
     * Aapne ye relationship pehle hi set ki hai
     */
    public function foods()
    {
        return $this->hasMany(Food::class);
    }
}
