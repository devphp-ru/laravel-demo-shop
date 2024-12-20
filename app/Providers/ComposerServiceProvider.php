<?php

namespace App\Providers;

use App\Models\Basket;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('front.components.category_list', function ($view) {
            $view->with('categoriesList', Category::getListNestedCategories());
        });

        View::composer('front.components.brands_list', function ($view) {
            $view->with('brandsList', Brand::query()->where('is_active', true)->get());
        });

        View::composer('front.layouts.blocks.navbar', function ($view) {
            $basketId = request()->cookie('basket_id');
            $basket = Basket::find($basketId);
            $view->with('basket_count', $basket?->getProductCount() ?? 0);
        });
    }

}
