<?php

namespace App\Services\Contracts;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

interface TagServiceInterface
{
    public function list(): Collection;
    public function create(array $data): Tag;
    public function show(Tag $tag): Tag;
    public function update(Tag $tag, array $data): Tag;
    public function delete(Tag $tag): void;
}
