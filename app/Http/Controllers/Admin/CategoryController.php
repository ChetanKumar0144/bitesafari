<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Services\FileService;
use App\Services\CategoryService;
use App\DTOs\CategoryDTO;

class CategoryController extends Controller
{
    public function __construct(
        protected FileService $fileService,
        protected CategoryService $categoryService
    ) {}

    // 1. List Categories
    public function index() {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.categories.index', compact('categories'));
    }

    // 2. Show Form
    public function create() {
        return view('admin.categories.create');
    }

    // 3. Save Data
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name',
            'image' => 'nullable|image'
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->fileService->upload($request->file('image'), 'uploads/categories');
        }

        $dto = CategoryDTO::fromRequest($validatedData, $imagePath);
        $request->validate(['name' => 'required|unique:categories,name']);

        $this->categoryService->createCategory($dto);

        return redirect()->route('admin.categories.index')->with('success', 'New Category Added!');

    }

    // 4. Edit Form
    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        // 1. Validation karke data array mein le lo
        $validatedData = $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
            'image' => 'nullable|image|max:2048',
            'status' => 'nullable'
        ]);

        $imagePath = $category->image; // Default purani image rakho

        // 2. Agar nayi image aayi hai toh purani delete karke nayi upload karo
        if ($request->hasFile('image')) {
            if ($category->image) {
                $this->fileService->delete($category->image);
            }
            $imagePath = $this->fileService->upload($request->file('image'), 'uploads/categories');
        }

        // 3. DTO mein array ($validatedData) pass karein
        $dto = CategoryDTO::fromRequest($validatedData, $imagePath);

        // 4. Service call
        $this->categoryService->updateCategory($category, $dto);

        return redirect()->route('admin.categories.index')->with('success', 'Category Updated!');
    }

    public function destroy($id) {
        $category = Category::findOrFail($id); // Manual fetch karna padega

        if ($category->image) {
            $this->fileService->delete($category->image);
        }

        $category->delete();
        return back()->with('success', 'Track Terminated!');
    }
}
