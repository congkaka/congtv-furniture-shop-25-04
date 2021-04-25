<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Cms\HomeController;
use App\Http\Controllers\Cms\CategoryController;
use App\Http\Controllers\Cms\BillController;

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
Route::resource('/product', HomeController::class);
Route::resource('/category', CategoryController::class);
Route::resource('/bill', BillController::class);
