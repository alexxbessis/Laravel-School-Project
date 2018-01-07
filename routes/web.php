<?php

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

Route::get('/', 'BlogController@index');
Route::get('/apropos', 'BlogController@apropos');
Route::resource('articles', 'ArticlesController');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
