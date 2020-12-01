<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => 'true']);
Route::as('admin.')->prefix('admin/')->namespace('Admin')->group(function () {
    Route::resource('/users', 'UserController');
    Route::get('/users/changeStatus/{id}', 'UserController@changeStatus')->name('users.changeStatus');
    Route::resource('/products', 'ProductController');
    Route::get('/products/changeStatus/{id}', 'ProductController@changeStatus')->name('products.changeStatus');
    Route::get('/products/export/o', 'ProductController@export')->name('products.export');
    Route::post('/products/import', 'ProductController@import')->name('products.import');
    Route::resource('/roles', 'RoleController');
    Route::resource('/categories', 'CategoryController');
    Route::resource('/orders', 'OrderController');
    Route::get('/metrics', 'MetricsController@chart')->name('metric');
    Route::get('/metrics/data', 'MetricsController@metric')->name('m');
    Route::get('/metrics/dato', 'MetricsController@met')->name('me');
    Route::get('/metrics/user-data', 'MetricsController@userMetric')->name('mu');
});
