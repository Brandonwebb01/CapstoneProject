<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::resource('cart', '\App\Http\Controllers\CartController');
Route::resource('items', '\App\Http\Controllers\ItemController');
Route::resource('categories', '\App\Http\Controllers\CategoryController');
Route::resource('products', '\App\Http\Controllers\ProductController');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    $Catcontroller = '\App\Http\Controllers\CategoryController';
    if (class_exists($Catcontroller)) {
        Route::resource('categories', $Catcontroller);
    } else {
        echo "Class $Catcontroller does not exist";
    }
    $Itemcontroller = '\App\Http\Controllers\ItemController';
    if (class_exists($Itemcontroller)) {
        Route::resource('items', $Itemcontroller);
    } else {
        echo "Class $Itemcontroller does not exist";
    }
    $ProductController = '\App\Http\Controllers\ProductController';
    if (class_exists($ProductController)) {
        Route::resource('products', $ProductController);
    } else {
        echo "Class $ProductController does not exist";
    }
    $CartController = '\App\Http\Controllers\CartController';
    if (class_exists($CartController)) {
        Route::resource('cart', $CartController);
    } else {
        echo "Class $CartController does not exist";
    }
    });
    

Route::get('/category/{id}/products', 'CategoryController@show');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/products/order', '\App\Http\Controllers\ProductController@order')->name('products.order');

Route::get('products/{id}/order', [\App\Http\Controllers\ProductController::class, 'order'])->name('products.order');

Route::get('/cart/{id?}/index', '\App\Http\Controllers\CartController@index')->name('cart.index');


