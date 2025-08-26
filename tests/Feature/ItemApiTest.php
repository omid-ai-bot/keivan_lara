<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_item(): void
    {
        $category = Category::create(['name' => 'Coffee']);
        $tag = Tag::create(['name' => 'Hot']);

        $response = $this->postJson('/api/admin/items', [
            'name' => 'Espresso',
            'category_ids' => [$category->id],
            'tag_ids' => [$tag->id],
        ]);

        $response->assertStatus(201)->assertJson(['name' => 'Espresso']);
        $this->assertDatabaseHas('items', ['name' => 'Espresso']);
    }

    public function test_create_item_validation_error(): void
    {
        $response = $this->postJson('/api/admin/items', []);

        $response->assertStatus(422);
    }

    public function test_show_item_not_found(): void
    {
        $response = $this->getJson('/api/admin/items/999');

        $response->assertStatus(404);
    }
}
