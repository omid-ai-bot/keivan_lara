<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Item;
use App\Models\Tag;
use App\Services\MenuService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_with_filters(): void
    {
        $category = Category::create(['name' => 'Coffee']);
        $tag = Tag::create(['name' => 'Hot']);

        $item = Item::create(['name' => 'Espresso']);
        $item->categories()->attach($category->id);
        $item->tags()->attach($tag->id);
        $item->variations()->create(['name' => 'Single', 'price' => 1.00]);

        $service = new MenuService();

        $items = $service->list($category->id, ['Hot']);
        $this->assertCount(1, $items);

        $items = $service->list(999, ['Hot']);
        $this->assertCount(0, $items);
    }
}
