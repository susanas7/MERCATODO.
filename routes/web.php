<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes(['verify' => 'true']);

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home/{product}', 'HomeController@show')->name('home.show');

Route::get('/category/{id}', 'HomeController@showCategory')->name('category');

Route::get('/add-to-cart/{id}', 'HomeController@addToCart')->name('addToCart');

Route::get('/shoppingCart', 'HomeController@shoppingCart')->name('shoppingCart');

Route::get('/reduce/{id}', 'HomeController@reduceByOne')->name('reduceByOne');
Route::get('/add/{id}', 'HomeController@addByOne')->name('addByOne');
Route::get('/remove/{id}', 'HomeController@removeItem')->name('removeItem');

Route::resource('/users', 'UserController');
Route::get('/users/changeStatus/{id}', 'UserController@changeStatus')->name('users.changeStatus');
Route::get('/myProfile' , 'UserController@myProfile')->name('myProfile');

Route::resource('/products', 'ProductController');
Route::get('/products/changeStatus/{id}', 'ProductController@changeStatus')->name('products.changeStatus');

Route::resource('/roles', 'RoleController');

Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::get('/categories/create', 'CategoryController@create')->name('categories.create');
Route::post('/categories', 'CategoryController@store')->name('categories.store');
Route::get('/categories/{category}/edit', 'CategoryController@edit')->name('categories.edit');
Route::put('/categories/{category}', 'CategoryController@update')->name('categories.update');
Route::delete('/categories/{category}', 'CategoryController@destroy')->name('categories.destroy');

Route::get('/orders', 'OrderController@index')->name('orders.index');
Route::post('/orders/store', 'OrderController@store')->name('orders.store');
Route::get('/orders/{id}', 'OrderController@show')->name('orders.show');
Route::get('/orders/successful/{id}', 'OrderController@orderSuccessful')->name('orders.successful');
Route::get('/myOrders', 'OrderController@myOrders')->name('myOrders');

Route::post('checkout/{id}', 'PlacetopayController@pay')->name('checkout');