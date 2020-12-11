<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'ProductTypeController@index')->name('homepage');

//('name', 'controller')
Route::resource('productType', 'ProductTypeController');
Route::resource('product', 'ProductController');
Route::get('/search/{id}', 'ProductController@search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//attach or detach product to user (add to product_user pivot table / cart)
Route::get('/{user_id}/{product_id}/attach', 'CartController@attach');
Route::get('/{user_id}/{product_id}/detach', 'CartController@detach');

//view shopping cart
Route::get('/cart/{id}', 'CartController@index');