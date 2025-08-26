<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_and_list_categories(): void
    {
        $service = new CategoryService();
        $service->create(['name' => 'Drinks']);

        $this->assertDatabaseHas('categories', ['name' => 'Drinks']);
        $this->assertCount(1, $service->list());
    }

    public function test_can_update_and_delete_category(): void
    {
        $service = new CategoryService();
        $category = $service->create(['name' => 'Coffee']);

        $service->update($category, ['name' => 'Tea']);
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Tea']);

        $service->delete($category);
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }
}
