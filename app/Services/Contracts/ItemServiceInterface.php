<?php

namespace App\Services\Contracts;

use App\Models\Item;
use Illuminate\Database\Eloquent\Collection;

interface ItemServiceInterface
{
    public function list(): Collection;
    public function create(array $data): Item;
    public function show(Item $item): Item;
    public function update(Item $item, array $data): Item;
    public function delete(Item $item): void;
}
