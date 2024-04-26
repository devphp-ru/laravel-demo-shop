<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop\Category;
use App\Models\Shop\Product;
use Illuminate\View\View;
use App\Enums\FieldStatus;

class CategoryController extends BaseController
{
    public function index(): View
    {
        $title = __('Каталог товаров');
        $perPage = 10;
        $products = Product::with('category')
            ->where('is_active', '=', FieldStatus::TURN_ON->value)
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        return view('shops.categories.index', [
            'title' => $title,
            'paginator' => $products,
        ]);
    }

    public function category(Category $category): View
    {
        $title = __('Категория: ' . $category->name);
        $perPage = 10;
        $products = Product::with('category')
            ->where('is_active', '=', FieldStatus::TURN_ON->value)
            ->where('category_id', '=', $category->id)
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        if ($products->isEmpty()) {
            $products = Product::with('category')
                ->where('is_active', '=', FieldStatus::TURN_ON)
                ->whereIn('category_id', function ($builder) use ($category) {
                   $builder->select('id')->from('categories')->where('parent_id', '=', $category->id);
                })->orderByDesc('id')
                ->paginate($perPage)
                ->withQueryString();
        }

        return view('shops.categories.single', [
            'title' => $title,
            'paginator' => $products,
        ]);
    }

}
