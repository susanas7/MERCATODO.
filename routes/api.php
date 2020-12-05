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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

/*Route::middleware('auth:api')
        ->prefix('api')
        ->group(function() {
            Route::apiResource('/products', 'Api\ProductController', ['as' => 'api']);
    });*/

/*Route::name('api.')->middleware('auth:api')->group(function () {
    Route::apiResource('/products', 'Api\ProductController');
});*/
//Route::apiResource('/products', 'Api\ProductController', ['as' => 'api'])->middleware('auth:sanctum');

/*Route::get('/storage/{img_route}', 'Api\ProductController@image', ['as' => 'api'])
    ->name('api.products.image');*/

    //Route::get('/api/login', 'Api\AuthController@login')->name('z.api.login');
    //Route::get('/api/logout', 'Api\AuthController@logout')->name('z.api.logout');

/*Route::as('api.')->namespace('Api')->middleware('auth:api')->group(function () {
    Route::apiResource('/products', 'ProductController');
});*/

Route::get('/products', 'Api\ProductController@index')->name('api.products.index')->middleware('auth:api');
Route::get('/products/{product}', 'Api\ProductController@show')->name('api.products.show')->middleware('auth:api');
Route::post('/products', 'Api\ProductController@store')->name('api.products.store')->middleware('auth:api');
Route::put('/products/{product}', 'Api\ProductController@update')->name('api.products.update')->middleware('auth:api');
Route::delete('/products/{product}', 'Api\ProductController@destroy')->name('api.products.destroy')->middleware('auth:api');

Route::as('api.')->get('/login', 'Api\AuthController@login')->name('login');

Route::get('/{img_route}', 'Api\ProductController@image')
    ->name('api.products.image');
