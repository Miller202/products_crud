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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('list_products', 'ProductController@index');
Route::post('save_product', 'ProductController@store');
Route::get('edit_product/{id}', 'ProductController@edit');
Route::put('update_product', 'ProductController@update');
Route::delete('delete_product/{id}', 'ProductController@destroy');
