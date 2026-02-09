<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;

class FoodApiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search', '');
        $categoryId = $request->query('category_id', '');

        $foodsQuery = Food::with('category');
        if (!empty($categoryId) && $categoryId != 0) {
            $foodsQuery->where('category_id', $categoryId);
        }

        if (!empty($search)) {
            $foodsQuery->where('name', 'like', "%{$search}%");
        }

        $foods = $foodsQuery->paginate($perPage);
        $foodData = $foods->map(function($food) {
            return [
                'id' => $food->id,
                'name' => $food->name,
                'price' => $food->price,
                'quantity' => $food->quantity,
                'description' => $food->description,
                'category' => $food->category->name ?? 'Uncategorized',
                'rating' => $food->rating ?? 4.5,
                'image' => $food->image ? asset($food->image) : asset('storage/foods/no-image.jpg'),
                'eta' => $this->generateETA(),
            ];
        });

        return response()->json([
            'success' => true,
            'current_page' => $foods->currentPage(),
            'last_page' => $foods->lastPage(),
            'per_page' => $foods->perPage(),
            'total' => $foods->total(),
            'foods' => $foodData,
        ]);
    }

    private function generateETA()
    {
        return rand(30, 45) . ' mins';
    }
}
