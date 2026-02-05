<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        return view('customer.dashboard');
    }

    public function categories()
    {
        return response()->json(
            Category::where('status', 1)->get()
        );
    }

    public function foods(Request $request)
    {
        $query = Food::where('status', 1);

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%");
        }

        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        return response()->json($query->latest()->get());
    }
}