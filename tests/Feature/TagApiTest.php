<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_tag(): void
    {
        $response = $this->postJson('/api/admin/tags', ['name' => 'Hot']);

        $response->assertStatus(201)->assertJson(['name' => 'Hot']);
        $this->assertDatabaseHas('tags', ['name' => 'Hot']);
    }

    public function test_create_tag_validation_error(): void
    {
        $response = $this->postJson('/api/admin/tags', []);

        $response->assertStatus(422);
    }

    public function test_show_tag_not_found(): void
    {
        $response = $this->getJson('/api/admin/tags/999');

        $response->assertStatus(404);
    }
}
