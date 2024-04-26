<?php

namespace App\Providers;

use App\Models\Shop\Category;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('shops.components.category_list', function ($view) {
            $view->with('categories', Category::getActiveList());
        });
    }
}
