<?php

namespace App\Http\Controllers\Shop;

use Illuminate\View\View;

class ShopController extends BaseController
{
    public function index(): View
    {
        $title = __(env('APP_NAME'));

        return view('shops.shop.index', [
            'title' => $title,
        ]);
    }

}
