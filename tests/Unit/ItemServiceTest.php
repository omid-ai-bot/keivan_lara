<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Item;
use App\Models\Tag;
use App\Services\ItemService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_update_and_delete_item(): void
    {
        $category1 = Category::create(['name' => 'Coffee']);
        $category2 = Category::create(['name' => 'Tea']);
        $tag1 = Tag::create(['name' => 'Hot']);
        $tag2 = Tag::create(['name' => 'Cold']);

        $service = new ItemService();
        $item = $service->create([
            'name' => 'Espresso',
            'category_ids' => [$category1->id],
            'tag_ids' => [$tag1->id],
        ]);

        $this->assertDatabaseHas('items', ['name' => 'Espresso']);
        $this->assertCount(1, $item->categories);
        $this->assertCount(1, $item->tags);

        $service->update($item, [
            'name' => 'Iced Espresso',
            'category_ids' => [$category2->id],
            'tag_ids' => [$tag2->id],
        ]);

        $this->assertDatabaseHas('items', ['id' => $item->id, 'name' => 'Iced Espresso']);
        $this->assertEquals($category2->id, $item->fresh()->categories->first()->id);
        $this->assertEquals($tag2->id, $item->fresh()->tags->first()->id);

        $service->delete($item);
        $this->assertDatabaseMissing('items', ['id' => $item->id]);
    }
}
