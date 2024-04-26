<?php

namespace App\Http\Controllers\Shop;

use App\Models\Shop\Product;
use Illuminate\View\View;

class ProductController extends BaseController
{
    public function show(Product $product): View
    {
        return view('shops.products.single', [
            'item' => $product,
        ]);
    }

}
