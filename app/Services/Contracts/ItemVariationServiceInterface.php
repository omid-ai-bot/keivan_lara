<?php

namespace App\Services\Contracts;

use App\Models\Item;
use App\Models\ItemVariation;

interface ItemVariationServiceInterface
{
    public function create(Item $item, array $data): ItemVariation;
    public function update(ItemVariation $variation, array $data): ItemVariation;
    public function delete(ItemVariation $variation): void;
}
