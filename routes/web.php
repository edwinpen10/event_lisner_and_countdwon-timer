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
Route::get('/menu', 'MenuController@list')->name('menu.list');
Route::post('/menu', 'MenuController@store')->name('menu.store');
Route::get('/setrole', 'MenuController@setrole')->name('menu.setrole');
Route::post('/storerole', 'MenuController@storerole')->name('menu.storerole');


Route::get('/list', 'TimerController@list')->name('timer');
Route::get('/order', 'TimerController@order');
Route::get('/update/status/{id}', 'TimerController@updatestatus')->name('status.update');
Route::get('/create', 'ProductController@create')->name('product.create');;
Route::post('/store', 'ProductController@store')->name('product.store');
Auth::routes();

Route::get('/home', 'HomeController@index')->middleware('verified')->name('home');
Route::get('/logout', 'Auth\LoginController@logout')->middleware('verified')->name('logout');
