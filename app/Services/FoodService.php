<?php

namespace App\Services;

use App\Models\Food;

class FoodService
{
    public function total(?int $vendorId = null): int
    {
        $query = Food::query();

        if ($vendorId) {
            $query->where('vendor_id', $vendorId);
        }

        return $query->count();
    }

    public function create(array $data): Food
    {
        return Food::create($data);
    }

    public function update(Food $food, array $data): Food
    {
        $food->update($data);
        return $food;
    }

    public function delete(Food $food): void
    {
        $food->delete();
    }

    public function byVendor(int $vendorId)
    {
        return Food::where('vendor_id', $vendorId)->paginate(10);
    }

}
