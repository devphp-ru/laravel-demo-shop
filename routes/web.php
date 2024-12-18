<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\CategoryController;
use App\Http\Controllers\Front\BrandController;

Route::get('/brands/{brand:slug}', [BrandController::class, 'show'])->name('brands.show');
Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
