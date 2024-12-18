<?php

namespace App\Http\Controllers\Front;

use App\Models\Brand;
use App\Models\Product;
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
        $title = __('Бренд: ' . $brand->name);
        $perPage = 12;

        $paginator = Product::query()
            ->with(['category', 'brand'])
            ->where('brand_id', $brand->id)
            ->orderByDesc('id')
            ->paginate($perPage);

        return view('front.brands.show', [
            'title' => $title,
            'brand' => $brand,
            'paginator' => $paginator,
        ]);
    }

}
