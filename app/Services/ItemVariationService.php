<?php

namespace App\Services;

use App\Models\Item;
use App\Models\ItemVariation;
use App\Services\Contracts\ItemVariationServiceInterface;

class ItemVariationService implements ItemVariationServiceInterface
{
    public function create(Item $item, array $data): ItemVariation
    {
        return $item->variations()->create($data);
    }

    public function update(ItemVariation $variation, array $data): ItemVariation
    {
        $variation->update($data);
        return $variation;
    }

    public function delete(ItemVariation $variation): void
    {
        $variation->delete();
    }
}
