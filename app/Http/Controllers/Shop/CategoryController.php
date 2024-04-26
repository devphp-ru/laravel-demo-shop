<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop\Category;
use Illuminate\View\View;

class CategoryController extends BaseController
{
    public function index(): View
    {
        $title = __('Каталог товаров');

        return view('shops.categories.index', [
            'title' => $title,
        ]);
    }

    public function category(Category $category): View
    {
        $title = __('Категория: ' . $category->name);

        return view('shops.categories.single', [
            'title' => $title,
        ]);
    }

}
