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

Route::get('login', 'Auth\LoginController')->name('user.login');
Route::get('register', 'Auth\RegisterController')->name('user.register');
Route::get('/dashboard', 'Task\DashboardController')->name('user.dashboard');