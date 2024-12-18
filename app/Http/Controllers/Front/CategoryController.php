<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\Product;
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
        $title = __('Категория: ' . $category->name);
        $perPage = 12;

        $paginator = Product::query()
            ->with(['category', 'brand'])
            ->where('is_active', true)
            ->where('category_id', $category->id)
            ->orderByDesc('id')
            ->paginate($perPage);

        if ($paginator->isEmpty()) {
            $paginator = Product::query()
                ->with(['category', 'brand'])
                ->where('is_active', true)
                ->whereIn('category_id', function ($builder) use ($category) {
                    $builder->select('id')->from('categories')->where('parent_id', $category->id);
                })
                ->orderByDesc('id')
                ->paginate($perPage);
        }

        return view('front.categories.show', [
            'title' => $title,
            'category' => $category,
            'paginator' => $paginator,
        ]);
    }

}
