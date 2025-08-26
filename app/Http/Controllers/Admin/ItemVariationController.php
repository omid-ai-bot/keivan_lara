<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemVariation;
use App\Services\Contracts\ItemVariationServiceInterface;
use Illuminate\Http\Request;

class ItemVariationController extends Controller
{
    public function __construct(private ItemVariationServiceInterface $variations)
    {
    }

    public function store(Request $request, Item $item)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        return $this->variations->create($item, $data);
    }

    public function update(Request $request, ItemVariation $variation)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'description' => 'nullable|string',
        ]);

        return $this->variations->update($variation, $data);
    }

    public function destroy(ItemVariation $variation)
    {
        $this->variations->delete($variation);
        return response()->noContent();
    }
}
