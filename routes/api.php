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

Route::name('api.')->group( function() {
    Route::apiResource('/products', 'Api\ProductController');
});
//Route::apiResource('/products', 'Api\ProductController', ['as' => 'api'])->middleware('auth:sanctum');

/*Route::get('/storage/{img_route}', 'Api\ProductController@image', ['as' => 'api'])
    ->name('api.products.image');*/

    Route::get('/api/login', 'Api\AuthController@login')->name('z.api.login');
    Route::get('/api/logout', 'Api\AuthController@logout')->name('z.api.logout');
