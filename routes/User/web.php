<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Route::get('/category/{id}', 'HomeController@showCategory')->name('category');

Route::get('/home/{product}', 'HomeController@show')->name('home.show');

Route::get('/add-to-cart/{id}', 'HomeController@addToCart')->name('addToCart');

Route::get('/shoppingCart', 'HomeController@shoppingCart')->name('shoppingCart');

Route::get('/reduce/{id}', 'HomeController@reduceByOne')->name('reduceByOne');

Route::get('/add/{id}', 'HomeController@addByOne')->name('addByOne');

Route::get('/remove/{id}', 'HomeController@removeItem')->name('removeItem');

Route::get('/myProfile', 'HomeController@myProfile')->name('myProfile');

Route::get('/myOrders', 'OrderController@myOrders')->name('myOrders');

Route::get('checkout/{order}', 'PlacetopayController@pay')->name('checkout');

Route::get('/editMyProfile', 'HomeController@editMyProfile')->name('editMyProfile');

Route::put('/updateMyProfile', 'HomeController@updateMyProfile')->name('updateMyProfile');

Route::get('/orders/payment/{order}', 'PlacetopayController@payment')->name('payment');
