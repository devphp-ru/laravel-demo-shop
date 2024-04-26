<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\ShopController;
use App\Http\Controllers\Shop\CategoryController;
use App\Http\Controllers\Shop\BrandController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/brands/{brand:slug}', [BrandController::class, 'brand'])->name('shop.brands.single');
Route::get('/brands', [BrandController::class, 'index'])->name('shop.brands.index');
Route::get('/catalog/{category:slug}', [CategoryController::class, 'category'])->name('shop.categories.single');
Route::get('/catalog', [CategoryController::class, 'index'])->name('shop.categories.index');
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
