<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('web.home');
Route::get('/product', [ProductController::class, 'index'])->name('product.detail');
Route::get('/product/listOrder', [ProductController::class, 'listOrder'])->name('product.listOrder');
Route::post('/product/order', [ProductController::class, 'order'])->name('product.order');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::delete('/product/{id}', [ProductController::class, 'delete'])->name('product.delete');
