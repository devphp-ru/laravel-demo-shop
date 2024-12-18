<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ShopController;


Route::get('/', [ShopController::class, 'index'])->name('shop.index');
