<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => 'true']);
Route::as('admin.')->prefix('admin/')->middleware('verified')->namespace('Admin')->group(function () {
    Route::resource('/users', 'UserController');
    Route::get('/users/changeStatus/{id}', 'UserController@changeStatus')->name('users.changeStatus');
    Route::resource('/products', 'ProductController');
    Route::get('/products/changeStatus/{id}', 'ProductController@changeStatus')->name('products.changeStatus');
    Route::get('/products/export/o', 'ProductController@export')->name('products.export');
    Route::post('/products/import', 'ProductController@import')->name('products.import');
    Route::resource('/roles', 'RoleController');
    Route::resource('/categories', 'CategoryController');
    Route::get('/orders', 'OrderController@index')->name('orders.index');
    Route::get('/orders/{order}', 'OrderController@show')->name('orders.show');
    Route::get('/metrics', 'MetricsController@chart')->name('metric');
    Route::get('/metrics/data', 'MetricsController@metricData')->name('metricData');
    Route::get('/metrics/data2', 'MetricsController@metricData2')->name('metricData2');
});
