<?php

namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function totalCustomers(): int
    {
        return Customer::count();
    }

    // CustomerService
    public function newToday(): int
    {
        return Customer::whereDate('created_at', today())->count();
    }

}
