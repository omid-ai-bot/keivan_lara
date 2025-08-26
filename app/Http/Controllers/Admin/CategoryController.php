<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::with('items')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string']);
        return Category::create($data);
    }

    public function show(Category $category)
    {
        return $category->load('items');
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate(['name' => 'required|string']);
        $category->update($data);
        return $category;
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->noContent();
    }
}
