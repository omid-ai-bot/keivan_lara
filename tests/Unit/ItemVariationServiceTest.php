<?php

namespace Tests\Unit;

use App\Models\Item;
use App\Services\ItemVariationService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemVariationServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_update_and_delete_variation(): void
    {
        $item = Item::create(['name' => 'Latte']);
        $service = new ItemVariationService();

        $variation = $service->create($item, [
            'name' => 'Small',
            'price' => 2.50,
        ]);

        $this->assertDatabaseHas('item_variations', ['name' => 'Small', 'item_id' => $item->id]);

        $service->update($variation, ['name' => 'Large']);
        $this->assertDatabaseHas('item_variations', ['id' => $variation->id, 'name' => 'Large']);

        $service->delete($variation);
        $this->assertDatabaseMissing('item_variations', ['id' => $variation->id]);
    }
}
