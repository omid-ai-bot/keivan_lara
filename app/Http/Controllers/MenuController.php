<?php

namespace App\Http\Controllers;

use App\Services\Contracts\MenuServiceInterface;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __construct(private MenuServiceInterface $menu)
    {
    }

    public function index(Request $request)
    {
        $category = $request->input('category');
        $tags = $request->filled('tags') ? explode(',', $request->input('tags')) : [];

        return $this->menu->list($category, $tags);
    }
}
