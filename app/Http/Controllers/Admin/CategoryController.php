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
        $request->validate(['name' => 'required|unique:categories,name']);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->fileService->upload($request->file('image'), 'uploads/categories');
        }

        $dto = CategoryDTO::fromRequest($request, $imagePath);
        $this->categoryService->createCategory($dto);

        return redirect()->route('admin.categories.index')->with('success', 'New Category Added!');

    }

    // 4. Edit Form
    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category) {
        $request->validate(['name' => 'required|unique:categories,name,' . $category->id]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            if ($category->image) $this->fileService->delete($category->image);
            $imagePath = $this->fileService->upload($request->file('image'), 'uploads/categories');
        }

        $dto = CategoryDTO::fromRequest($request, $imagePath);
        $this->categoryService->updateCategory($category, $dto);

        return redirect()->route('admin.categories.index')->with('success', 'Category Updated!');
    }

    public function destroy(Category $category) {
        if ($category->image) $this->fileService->delete($category->image);
        $category->delete();
        return back()->with('success', 'Track Terminated!');
    }
}
