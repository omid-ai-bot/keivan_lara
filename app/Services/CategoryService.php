<?php

namespace App\Services;

use App\Models\Category;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class CategoryService implements CategoryServiceInterface
{
    public function list(): Collection
    {
        return Category::with('items')->get();
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function show(Category $category): Category
    {
        return $category->load('items');
    }

    public function update(Category $category, array $data): Category
    {
        $category->update($data);
        return $category;
    }

    public function delete(Category $category): void
    {
        $category->delete();
    }
}
