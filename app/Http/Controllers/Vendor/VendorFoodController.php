<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Services\FoodService;
use App\Services\FileService;
use Illuminate\Http\Request;
use App\Models\Category;

class VendorFoodController extends Controller
{

    public function __construct(
        protected FoodService $foodService,
        protected FileService $fileService
    ) {}

    // List all foods for this vendor
    public function index()
    {
        $vendorId = auth('vendor')->id();
        $foods = $this->foodService->byVendor($vendorId);

        return view('vendor.foods.index', compact('foods'));
    }

    // Show create food form
    public function create()
    {
        $categories = Category::all();
        return view('vendor.foods.create',compact('categories'));
    }

    // Store new food
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:food',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        if($request->hasFile('image')){
            $data['image'] = $this->fileService->upload($request->file('image'), 'uploads/foods');
        }

        $data['rating'] = $data['rating'] ?? 4.5;

        $data['vendor_id'] = auth('vendor')->id();
        $this->foodService->create($data);

        return redirect()->route('vendor.foods.index')->with('success', 'Food created successfully');
    }

    // Show edit form
    public function edit($foodId)
    {
        $categories = Category::all();
        $food = $this->foodService->byVendor(auth('vendor')->id())->where('id', $foodId)->firstOrFail();
        return view('vendor.foods.edit', compact('food','categories'));
    }

    // Update food
    public function update(Request $request, $foodId)
    {
        $food = $this->foodService->byVendor(auth('vendor')->id())->where('id', $foodId)->firstOrFail();

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:food,name,' . $food->id,
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:1000',
            'quantity' => 'required|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);
        if($request->hasFile('image')){
            if($food->image){
                $this->fileService->delete($food->image);
            }
            $data['image'] = $this->fileService->upload($request->file('image'), 'uploads/foods');
        }

        $data['rating'] = $data['rating'] ?? $food->rating ?? 4.5;


        $this->foodService->update($food, $data);

        return redirect()->route('vendor.foods.index')->with('success', 'Food updated successfully');
    }

    // Delete food
    public function destroy($foodId)
    {
        $food = $this->foodService->byVendor(auth('vendor')->id())->where('id', $foodId)->firstOrFail();

        if($food->image){
            $this->fileService->delete($food->image);
        }

        $this->foodService->delete($food);

        return redirect()->route('vendor.foods.index')->with('success', 'Food deleted successfully');
    }
}
