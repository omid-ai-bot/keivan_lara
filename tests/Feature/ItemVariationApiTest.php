<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemVariationApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_item_variation(): void
    {
        $item = Item::create(['name' => 'Latte']);

        $response = $this->postJson("/api/admin/items/{$item->id}/variations", [
            'name' => 'Small',
            'price' => 2.50,
        ]);

        $response->assertStatus(201)->assertJson(['name' => 'Small']);
        $this->assertDatabaseHas('item_variations', ['name' => 'Small', 'item_id' => $item->id]);
    }

    public function test_create_item_variation_validation_error(): void
    {
        $item = Item::create(['name' => 'Latte']);

        $response = $this->postJson("/api/admin/items/{$item->id}/variations", []);

        $response->assertStatus(422);
    }

    public function test_create_variation_item_not_found(): void
    {
        $response = $this->postJson('/api/admin/items/999/variations', [
            'name' => 'Small',
            'price' => 2.50,
        ]);

        $response->assertStatus(404);
    }
}
