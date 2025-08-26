<?php

namespace Tests\Unit;

use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_and_list_tags(): void
    {
        $service = new TagService();
        $service->create(['name' => 'Hot']);

        $this->assertDatabaseHas('tags', ['name' => 'Hot']);
        $this->assertCount(1, $service->list());
    }

    public function test_can_update_and_delete_tag(): void
    {
        $service = new TagService();
        $tag = $service->create(['name' => 'Cold']);

        $service->update($tag, ['name' => 'Iced']);
        $this->assertDatabaseHas('tags', ['id' => $tag->id, 'name' => 'Iced']);

        $service->delete($tag);
        $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
    }
}
