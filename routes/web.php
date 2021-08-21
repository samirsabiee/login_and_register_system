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

Auth::routes();
Route::view('/', 'home')->name('home');
Route::view('/login', 'auth.login')->name('login');
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('auth.register.form');
    Route::post('/register', 'RegisterController@register')->name('auth.register');
});

