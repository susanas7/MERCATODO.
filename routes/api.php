<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/products', 'Api\ProductController@index')->name('api.products.index')->middleware('auth:api');
Route::get('/products/{product}', 'Api\ProductController@show')->name('api.products.show')->middleware('auth:api');
Route::post('/products', 'Api\ProductController@store')->name('api.products.store')->middleware('auth:api');
Route::put('/products/{product}', 'Api\ProductController@update')->name('api.products.update')->middleware('auth:api');
Route::delete('/products/{product}', 'Api\ProductController@destroy')->name('api.products.destroy')->middleware('auth:api');

Route::as('api.')->get('/login', 'Api\AuthController@login')->name('login');

Route::get('/{img_route}', 'Api\ProductController@image')
    ->name('api.products.image');
