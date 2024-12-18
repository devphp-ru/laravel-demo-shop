<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends BaseController
{
    public function index(): View
    {
        $title = __('Категории');

        $categories = Category::getListNestedCategories();

        return view('front.categories.index', [
            'title' => $title,
            'categories' => $categories,
        ]);
    }

    public function show(Category $category): View
    {
        $title = __($category->name);

        return view('front.categories.show', [
            'title' => $title,
            'category' => $category,
        ]);
    }

}
