<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Brand;
use App\Models\Shop\Product;
use Illuminate\View\View;
use App\Enums\FieldStatus;

class BrandController extends Controller
{
    public function index(): View
    {
        $title = __('Бренды товаров');
        $perPage = 10;

        $brands = Product::with('category', 'brand')
            ->where('is_active', '=', FieldStatus::TURN_ON->value)
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        return view('shops.brands.index', [
            'title' => $title,
            'paginator' => $brands,
        ]);
    }

    public function brand(Brand $brand): View
    {
        $title = __('Бренд: ' . $brand->name);
        $perPage = 10;

        $products = Product::with('category', 'brand')
            ->where('is_active', '=', FieldStatus::TURN_ON->value)
            ->where('brand_id', '=', $brand->id)
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();

        return view('shops.brands.single', [
            'title' => $title,
            'paginator' => $products
        ]);
    }

}
