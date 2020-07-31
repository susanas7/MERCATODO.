<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redis;

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

Route::get('/home/{product}', 'HomeController@show')->name('home.show');

Route::resource('/users', 'UserController');
Route::get('/users/changeStatus/{id}', 'UserController@changeStatus')->name('users.changeStatus');

Route::resource('/products', 'ProductController');
Route::get('/products/changeStatus/{id}','ProductController@changeStatus')->name('products.changeStatus');

Route::resource('/roles', 'RoleController');


