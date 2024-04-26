<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Brand;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(): View
    {
        $title = __('Бренды товаров');

        return view('shops.brands.index', [
            'title' => $title,
        ]);
    }

    public function brand(Brand $brand): View
    {
        $title = __('Бренд: ' . $brand->name);

        return view('shops.brands.single', [
            'title' => $title,
        ]);
    }

}
