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

Route::get('/', 'VoucherController@index');

Route::resource('vouchers', 'VoucherController');

Route::view('/contact', 'contact')->name('contact');
Route::view('/privacy-policy', 'privacy-policy')->name('policy');
Route::view('/terms','terms')->name('terms');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout')->name('logout');