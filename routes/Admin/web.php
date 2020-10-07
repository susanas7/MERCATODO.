<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => 'true']);
Route::resource('/users', 'UserController');
Route::get('/users/changeStatus/{id}', 'UserController@changeStatus')->name('users.changeStatus');

Route::resource('/products', 'ProductController');
Route::get('/products/changeStatus/{id}', 'ProductController@changeStatus')->name('products.changeStatus');

Route::resource('/roles', 'RoleController');

Route::resource('/categories', 'CategoryController');

Route::resource('/orders', 'OrderController');