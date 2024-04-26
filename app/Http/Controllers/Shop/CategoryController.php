<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop\Category;
use Illuminate\View\View;

class CategoryController extends BaseController
{
    public function index(): View
    {
        $title = __('Каталог товаров');

        $categories = Category::with('children')->where('parent_id', '=', 0)->get();

        return view('shops.categories.index', [
            'title' => $title,
            'categories' => $categories,
        ]);
    }

    public function category(Category $category): View
    {
        $title = __('Категория: ' . $category->name);

        $categories = Category::with('children')->where('parent_id', '=', 0)->get();

        return view('shops.categories.single', [
            'title' => $title,
            'categories' => $categories,
        ]);
    }

}
