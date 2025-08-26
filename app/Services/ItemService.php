<?php

namespace App\Services;

use App\Models\Item;
use App\Services\Contracts\ItemServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class ItemService implements ItemServiceInterface
{
    public function list(): Collection
    {
        return Item::with(['categories', 'tags', 'variations'])->get();
    }

    public function create(array $data): Item
    {
        $item = Item::create($data);
        $item->categories()->sync($data['category_ids'] ?? []);
        $item->tags()->sync($data['tag_ids'] ?? []);

        return $item->load(['categories', 'tags', 'variations']);
    }

    public function show(Item $item): Item
    {
        return $item->load(['categories', 'tags', 'variations']);
    }

    public function update(Item $item, array $data): Item
    {
        $item->update($data);

        if (isset($data['category_ids'])) {
            $item->categories()->sync($data['category_ids']);
        }

        if (isset($data['tag_ids'])) {
            $item->tags()->sync($data['tag_ids']);
        }

        return $item->load(['categories', 'tags', 'variations']);
    }

    public function delete(Item $item): void
    {
        $item->delete();
    }
}
