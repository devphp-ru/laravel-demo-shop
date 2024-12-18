<?php

namespace App\Http\Controllers\Front;

use App\Models\Brand;
use Illuminate\View\View;

class BrandController extends BaseController
{
    public function index(): View
    {
        $title = __('Бренды');

        $brands = Brand::query()->where('is_active', true)->get();

        return view('front.brands.index', [
            'title' => $title,
            'brands' => $brands,
        ]);
    }

    public function show(Brand $brand): View
    {
        $title = __($brand->name);

        return view('front.brands.show', [
            'title' => $title,
            'brand' => $brand,
        ]);
    }

}
