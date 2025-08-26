<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Item;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_get_menu_with_filters(): void
    {
        $category = Category::create(['name' => 'Coffee']);
        $tag = Tag::create(['name' => 'Hot']);

        $item = Item::create(['name' => 'Espresso']);
        $item->categories()->attach($category->id);
        $item->tags()->attach($tag->id);
        $item->variations()->create(['name' => 'Single', 'price' => 1.00]);

        $response = $this->getJson('/api/menu?category=' . $category->id . '&tags=Hot');

        $response->assertStatus(200)->assertJsonCount(1);
    }

    public function test_menu_with_invalid_tags_parameter_returns_error(): void
    {
        $response = $this->getJson('/api/menu?tags[]=bad');

        $response->assertStatus(500);
    }
}
