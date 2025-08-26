<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with(['categories', 'tags', 'variations']);

        if ($request->filled('category')) {
            $category = $request->input('category');
            $query->whereHas('categories', fn ($q) => $q->where('id', $category));
        }

        if ($request->filled('tags')) {
            $tags = explode(',', $request->input('tags'));
            $query->whereHas('tags', fn ($q) => $q->whereIn('name', $tags));
        }

        return $query->get();
    }
}
