<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function totalUsers(): int
    {
        return User::where('role', 'user')->count();
    }

    // CustomerService
    public function newToday(): int
    {
        return User::where('role', 'user')->whereDate('created_at', today())->count();
    }

}
