<?php

namespace App\Http\Controllers\Front;

use Illuminate\View\View;

class ShopController extends BaseController
{
    public function index(): View
    {
        return view('front.shop.index');
    }

}
