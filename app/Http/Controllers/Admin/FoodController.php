<?php

namespace App\Http\Controllers\Admin;

use App\Models\Food;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Vendor;
use App\Services\FoodService;
use App\Services\VendorService;

class FoodController extends Controller
{
    public function __construct(
        protected FoodService $foodService,
        protected VendorService $vendorService
    ) {}

    public function index(Request $request)
    {
        $query = Food::query();

        // Filter by vendor
        if ($request->vendor_id) {
            $query->where('vendor_id', $request->vendor_id);
        }

        // Filter by categories
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        // Search by food name
        if ($request->search) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $foods = $query->paginate(10)->withQueryString(); // keep query params in pagination

        $vendors = $this->vendorService->all(); // for dropdown
        $categories = Category::all();

        return view('admin.food.index', compact('foods', 'vendors', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        $vendors = $this->vendorService->all();
        return view('admin.food.create', compact('categories','vendors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:food',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'vendor_id' => 'nullable|exists:vendors,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        if($request->hasFile('image')){
            $validated['image'] = $request->file('image')->store('foods','public');
        }

        $validated['rating'] = $validated['rating'] ?? 4.5;

        $this->foodService->create($validated);

        return redirect()->route('food.index')->with('success','Food created successfully!');
    }


    public function edit(Food $food)
    {
        $categories = Category::all();
        $vendors = $this->vendorService->all();
        return view('admin.food.edit', compact('food','categories','vendors'));
    }

    public function update(Request $request, Food $food)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:food,name,' . $food->id,
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'vendor_id' => 'nullable|exists:vendors,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        if($request->hasFile('image')){
            if($food->image && file_exists(storage_path('app/public/'.$food->image))){
                unlink(storage_path('app/public/'.$food->image));
            }
            $validated['image'] = $request->file('image')->store('foods','public');
        }

        $validated['rating'] = $validated['rating'] ?? $food->rating ?? 4.5;

        $this->foodService->update($food, $validated);

        return redirect()->route('food.index')->with('success','Food updated successfully!');
    }


    public function destroy(Food $food)
    {
        $this->foodService->delete($food);
        return redirect()->route('food.index')->with('success','Food deleted successfully!');
    }

    public function categories()
    {
        return view('admin.food.categories');
    }
}
