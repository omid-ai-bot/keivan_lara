<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_category(): void
    {
        $response = $this->postJson('/api/admin/categories', ['name' => 'Drinks']);

        $response->assertStatus(201)->assertJson(['name' => 'Drinks']);
        $this->assertDatabaseHas('categories', ['name' => 'Drinks']);
    }

    public function test_create_category_validation_error(): void
    {
        $response = $this->postJson('/api/admin/categories', []);

        $response->assertStatus(422);
    }

    public function test_show_category_not_found(): void
    {
        $response = $this->getJson('/api/admin/categories/999');

        $response->assertStatus(404);
    }
}
