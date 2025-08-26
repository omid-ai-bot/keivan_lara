<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\ItemVariationController;

Route::get('menu', [MenuController::class, 'index']);

Route::prefix('admin')->group(function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('tags', TagController::class);
    Route::apiResource('items', ItemController::class);
    Route::apiResource('items.variations', ItemVariationController::class)->shallow();
});
