<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Services\FileService;

class CategoryController extends Controller
{
    public function __construct(
        protected FileService $fileService
    ) {}

    // 1. List Categories
    public function index() {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    // 2. Show Form
    public function create() {
        return view('admin.categories.create');
    }

    // 3. Save Data
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|unique:categories,name'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->fileService->upload($request->file('image'), 'uploads/categories');
        }

        return redirect()->route('admin.categories.index')->with('success', 'New Track Added!');
    }

    // 4. Edit Form
    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // 5. Update Data
    public function update(Request $request, $id) {
        $category = Category::findOrFail($id);

        $request->validate(['name' => 'required']);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        if ($request->hasFile('image')) {
            if ($category->image) {
                $this->fileService->delete($category->image);
            }
            $data['image'] = $this->fileService->upload($request->file('image'), 'uploads/categories');
        }

        return redirect()->route('admin.categories.index')->with('success', 'Category Updated!');
    }

    // 6. Manual Delete
    public function destroy(Category $category) {
        if ($category->image) {
            $this->fileService->delete($category->image);
        }
        $category->delete();
        return back()->with('success', 'Track Terminated!');
    }
}
