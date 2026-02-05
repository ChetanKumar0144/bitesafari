<?php

namespace App\Services;

use App\Models\Vendor;

class VendorService
{
    public function totalVendors(): int
    {
        return Vendor::count();
    }

    public function newToday(): int
    {
        return Vendor::whereDate('created_at', today())->count();
    }

    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return Vendor::all();
    }

    public function find(int $id): ?Vendor
    {
        return Vendor::find($id);
    }
}
