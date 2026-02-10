<?php

namespace App\Services;

use App\Models\Category;
use App\DTOs\CategoryDTO;
use Illuminate\Support\Collection;

class CategoryService
{
    public function getAllCategories(): Collection
    {
        return Category::orderBy('id', 'desc')->get();
    }

    public function createCategory(CategoryDTO $dto): Category
    {
        return Category::create([
            'name'  => $dto->name,
            'slug'  => $dto->slug,
            'image' => $dto->image,
            'status'=> $dto->status,
        ]);
    }

    public function updateCategory(Category $category, CategoryDTO $dto): bool
    {
        return $category->update([
            'name'  => $dto->name,
            'slug'  => $dto->slug,
            'image' => $dto->image ?? $category->image,
            'status'=> $dto->status,
        ]);
    }

    public function deleteCategory(Category $category): bool
    {
        return $category->delete();
    }
}
