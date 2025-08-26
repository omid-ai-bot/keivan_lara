<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        return Tag::with('items')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string']);
        return Tag::create($data);
    }

    public function show(Tag $tag)
    {
        return $tag->load('items');
    }

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate(['name' => 'required|string']);
        $tag->update($data);
        return $tag;
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return response()->noContent();
    }
}
