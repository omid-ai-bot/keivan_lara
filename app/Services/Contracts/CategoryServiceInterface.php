<?php

namespace App\Services\Contracts;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

interface CategoryServiceInterface
{
    public function list(): Collection;
    public function create(array $data): Category;
    public function show(Category $category): Category;
    public function update(Category $category, array $data): Category;
    public function delete(Category $category): void;
}
