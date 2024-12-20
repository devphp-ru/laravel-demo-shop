<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\BrandController;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\BasketController;


Route::post('/basket/clear', [BasketController::class, 'clear'])->name('baskets.clear');
Route::post('/basket/remove/{id}', [BasketController::class, 'remove'])->where(['id' => '[0-9]+'])->name('baskets.remove');
Route::post('/basket/minus/{id}', [BasketController::class, 'minus'])->where(['id' => '[0-9]+'])->name('baskets.minus');
Route::post('/basket/plus/{id}', [BasketController::class, 'plus'])->where(['id' => '[0-9]+'])->name('baskets.plus');
Route::post('/basket/add/{id}', [BasketController::class, 'add'])->where(['id' => '[0-9]+'])->name('baskets.add');
Route::get('/basket/checkout', [BasketController::class, 'checkout'])->name('baskets.checkout');
Route::get('/basket', [BasketController::class, 'index'])->name('baskets.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/brands/{brand:slug}', [BrandController::class, 'show'])->name('brands.show');
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
