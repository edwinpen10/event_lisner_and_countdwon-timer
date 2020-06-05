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

Auth::routes(['verify' => true ]);

Route::get('/list', 'TimerController@list')->name('timer');
Route::get('/order', 'TimerController@order');
Route::get('/create', 'ProductController@create')->name('product.create');;
Route::post('/store', 'ProductController@store')->name('product.store');
Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');
