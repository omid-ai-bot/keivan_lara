<?php

namespace App\Services;

use App\Models\Item;
use App\Services\Contracts\MenuServiceInterface;
use Illuminate\Database\Eloquent\Collection;

class MenuService implements MenuServiceInterface
{
    public function list(?int $categoryId = null, array $tags = []): Collection
    {
        $query = Item::with(['categories', 'tags', 'variations']);

        if ($categoryId) {
            $query->whereHas('categories', fn ($q) => $q->where('id', $categoryId));
        }

        if ($tags) {
            $query->whereHas('tags', fn ($q) => $q->whereIn('name', $tags));
        }

        return $query->get();
    }
}
