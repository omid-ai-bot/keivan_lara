<?php

namespace App\Providers;

use App\Services\CategoryService;
use App\Services\Contracts\CategoryServiceInterface;
use App\Services\Contracts\ItemServiceInterface;
use App\Services\Contracts\ItemVariationServiceInterface;
use App\Services\Contracts\MenuServiceInterface;
use App\Services\Contracts\TagServiceInterface;
use App\Services\ItemService;
use App\Services\ItemVariationService;
use App\Services\MenuService;
use App\Services\TagService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(TagServiceInterface::class, TagService::class);
        $this->app->bind(ItemServiceInterface::class, ItemService::class);
        $this->app->bind(ItemVariationServiceInterface::class, ItemVariationService::class);
        $this->app->bind(MenuServiceInterface::class, MenuService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
