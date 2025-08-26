<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Contracts\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(private CategoryServiceInterface $categories)
    {
    }

    public function index()
    {
        return $this->categories->list();
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string']);
        return $this->categories->create($data);
    }

    public function show(Category $category)
    {
        return $this->categories->show($category);
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate(['name' => 'required|string']);
        return $this->categories->update($category, $data);
    }

    public function destroy(Category $category)
    {
        $this->categories->delete($category);
        return response()->noContent();
    }
}
