<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\ItemVariation;
use Illuminate\Http\Request;

class ItemVariationController extends Controller
{
    public function store(Request $request, Item $item)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        return $item->variations()->create($data);
    }

    public function update(Request $request, ItemVariation $variation)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'description' => 'nullable|string',
        ]);

        $variation->update($data);
        return $variation;
    }

    public function destroy(ItemVariation $variation)
    {
        $variation->delete();
        return response()->noContent();
    }
}
