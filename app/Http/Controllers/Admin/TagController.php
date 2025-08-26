<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Services\Contracts\TagServiceInterface;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct(private TagServiceInterface $tags)
    {
    }

    public function index()
    {
        return $this->tags->list();
    }

    public function store(Request $request)
    {
        $data = $request->validate(['name' => 'required|string']);
        return $this->tags->create($data);
    }

    public function show(Tag $tag)
    {
        return $this->tags->show($tag);
    }

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate(['name' => 'required|string']);
        return $this->tags->update($tag, $data);
    }

    public function destroy(Tag $tag)
    {
        $this->tags->delete($tag);
        return response()->noContent();
    }
}
