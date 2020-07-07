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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([ 'verify' => 'true' ]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/users', 'UserController@index')->name('users.index');
Route::post('/users/store', 'UserController@store')->name('users.store');
Route::delete('/users/{user}', 'UserController@destroy')->name('users.destroy');
Route::get('/users/{user}/edit', 'UserController@edit')->name('users.edit');
Route::put('/users/{user}/update', 'UserController@update')->name('users.update');

/*Route::get('/products', 'ProductController@index')->name('products.index');
Route::post('/products/store', 'ProductCOntroller@store')->name('products.store');
Route::delete('/products/{product}', 'ProductController@destroy')->name('products.destroy');*/

Route::resource('/products', 'ProductController');