<?php

namespace App\Services;

use App\Models\Tag;
use App\Services\Contracts\TagServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class TagService implements TagServiceInterface
{
    public function list(): Collection
    {
        return Tag::with('items')->get();
    }

    public function create(array $data): Tag
    {
        return Tag::create($data);
    }

    public function show(Tag $tag): Tag
    {
        return $tag->load('items');
    }

    public function update(Tag $tag, array $data): Tag
    {
        $tag->update($data);
        return $tag;
    }

    public function delete(Tag $tag): void
    {
        $tag->delete();
    }
}
