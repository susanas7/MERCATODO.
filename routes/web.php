<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index')->name('home');

Route::get('/category/{id}', 'HomeController@showCategory')->name('category');

Route::get('/home/{product}', 'HomeController@show')->name('home.show');
