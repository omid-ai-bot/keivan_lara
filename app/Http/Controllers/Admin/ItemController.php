<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return Item::with(['categories', 'tags', 'variations'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'category_ids' => 'array',
            'category_ids.*' => 'integer',
            'tag_ids' => 'array',
            'tag_ids.*' => 'integer',
        ]);

        $item = Item::create($data);
        $item->categories()->sync($data['category_ids'] ?? []);
        $item->tags()->sync($data['tag_ids'] ?? []);

        return $item->load(['categories', 'tags', 'variations']);
    }

    public function show(Item $item)
    {
        return $item->load(['categories', 'tags', 'variations']);
    }

    public function update(Request $request, Item $item)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'category_ids' => 'array',
            'category_ids.*' => 'integer',
            'tag_ids' => 'array',
            'tag_ids.*' => 'integer',
        ]);

        $item->update($data);

        if (isset($data['category_ids'])) {
            $item->categories()->sync($data['category_ids']);
        }

        if (isset($data['tag_ids'])) {
            $item->tags()->sync($data['tag_ids']);
        }

        return $item->load(['categories', 'tags', 'variations']);
    }

    public function destroy(Item $item)
    {
        $item->delete();
        return response()->noContent();
    }
}
