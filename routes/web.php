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

Route::get('/home/{product}', 'HomeController@show')->name('home.show');

//Route::resource('/users', 'UserController');

Route::middleware(['auth'])->group(function(){

    //usuarios
    Route::post('users', 'UserController@store')->name('users.store')
        ->middleware('permission:crear usuario');
    
    Route::get('users', 'UserController@index')->name('users.index')
        ->middleware('permission:ver usuario');
    
    Route::get('users/create', 'UserController@create')->name('users.create')
        ->middleware('permission:crear usuario');
    
    Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')
        ->middleware('permission:eliminar usuario');
    
    Route::put('users/{user}', 'UserController@update')->name('users.update')
        ->middleware('permission:editar usuario');
    
    Route::get('users/{user}', 'UserController@show')->name('users.show')
        ->middleware('permission:ver usuario');
    
    Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')
        ->middleware('permission:editar usuario');

    Route::get('/users/changeStatus/{id}', 'UserController@changeStatus')->name('users.changeStatus');
});


//Route::resource('/products', 'ProductController');

Route::middleware(['auth'])->group(function(){

    //productos
    Route::post('products', 'ProductController@store')->name('products.store')
        ->middleware('permission:crear producto');
    
    Route::get('products', 'ProductController@index')->name('products.index')
        ->middleware('permission:ver producto');
    
    Route::get('products/create', 'ProductController@create')->name('products.create')
        ->middleware('permission:crear producto');
    
    Route::delete('products/{product}', 'ProductController@destroy')->name('products.destroy')
        ->middleware('permission:eliminar producto');
    
    Route::put('products/{product}', 'ProductController@update')->name('products.update')
        ->middleware('permission:editar producto');
    
    Route::get('products/{product}', 'ProductController@show')->name('products.show')
        ->middleware('permission:ver producto');
    
    Route::get('products/{product}/edit', 'ProductController@edit')->name('products.edit')
        ->middleware('permission:editar producto');
});

//Route::resource('/roles', 'RoleController');

Route::middleware(['auth'])->group(function(){

    //roles
    Route::post('roles', 'RoleController@store')->name('roles.store')
        ->middleware('permission:crear rol');
    
    Route::get('roles', 'RoleController@index')->name('roles.index')
        ->middleware('permission:ver rol');
    
    Route::get('roles/create', 'RoleController@create')->name('roles.create')
        ->middleware('permission:crear rol');
    
    Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
        ->middleware('permission:eliminar rol');
    
    Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
        ->middleware('permission:editar rol');
    
    Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
        ->middleware('permission:ver rol');
    
    Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
        ->middleware('permission:editar rol');
});