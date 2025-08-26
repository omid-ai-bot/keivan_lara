<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Services\Contracts\ItemServiceInterface;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __construct(private ItemServiceInterface $items)
    {
    }

    public function index()
    {
        return $this->items->list();
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

        return $this->items->create($data);
    }

    public function show(Item $item)
    {
        return $this->items->show($item);
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

        return $this->items->update($item, $data);
    }

    public function destroy(Item $item)
    {
        $this->items->delete($item);
        return response()->noContent();
    }
}
