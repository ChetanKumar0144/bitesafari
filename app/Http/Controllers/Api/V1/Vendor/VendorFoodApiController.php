<?php

namespace App\Http\Controllers\Api\V1\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Services\FoodService;

class VendorFoodApiController extends Controller
{
    public function __construct(
        protected FoodService $foodService
    ) {}

    public function foods(Request $request)
    {
        $vendor = Auth::guard('sanctum')->user();
        if (!$vendor) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
                'data' => []
            ], 401);
        }

        $foods = $this->foodService->byVendor($vendor->id);

        return response()->json([
            'status'  => true,
            'message' => 'Food List Fetched successfully!',
            'data'    => $foods
        ], 200);
    }
}
