<?php

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

Route::get('/', function (App\User $user) {
    return view('welcome', compact('user'));
});

Auth::routes();

Route::get('/index', 'ProductsController@index')->name('products.index');
Route::get('/product/create', 'ProductsController@create');
Route::post('/product', 'ProductsController@store');
Route::get('/product/{product}/edit', 'ProductsController@edit')->name('product.edit');
Route::patch('/product/{product}', 'ProductsController@update')->name('product.update');
Route::delete('/product/{product}', 'ProductsController@destroy')->name('product.destroy');
