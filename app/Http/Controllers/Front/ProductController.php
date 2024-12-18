<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends BaseController
{
    public function show(Product $product): View
    {
        $title = __($product->title);

        return view('front.products.show', [
            'title' => $title,
            'product' => $product,
        ]);
    }

}
