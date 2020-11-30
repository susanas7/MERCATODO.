<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => 'true']);
Route::as('user.')->prefix('user/')->namespace('User')->group(function () {
    Route::get('/add-to-cart/{id}', 'ShopController@addToCart')->name('addToCart');
    Route::get('/shoppingCart', 'ShopController@shoppingCart')->name('shoppingCart');
    Route::get('/reduce/{id}', 'ShopController@reduceByOne')->name('reduceByOne');
    Route::get('/add/{id}', 'ShopController@addByOne')->name('addByOne');
    Route::get('/remove/{id}', 'ShopController@removeItem')->name('removeItem');
    Route::get('/myProfile', 'UserAuthController@myProfile')->name('myProfile');
    Route::get('/myOrders', 'UserAuthController@myOrders')->name('myOrders');
    Route::get('/editMyProfile', 'UserAuthController@editMyProfile')->name('editMyProfile');
    Route::put('/updateMyProfile', 'UserAuthController@updateMyProfile')->name('updateMyProfile');
    Route::get('/newAPiToken', 'UserAuthController@newApiToken')->name('newApiToken');
    Route::get('/deleteAPiToken', 'UserAuthController@deleteApiToken')->name('deleteApiToken');
    Route::get('checkout/{order}', 'PaymentController@pay')->name('checkout');
    Route::get('/orders/payment/{order}', 'PaymentController@payment')->name('payment');
    Route::post('/storeOrder', 'ShopController@storeCart')->name('store.order');
});
