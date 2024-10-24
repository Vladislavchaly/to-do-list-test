<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'user', 'namespace' => 'User', 'middleware' => 'auth:api'], function () {
    Route::get('/', 'GetController')->name('user.get');
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function () {
    Route::post('register', 'RegistrationController')->name('auth.register');
    Route::post('login', 'LoginController')->name('auth.login');
    Route::delete('logout', 'LogoutController')->name('auth.logout')->middleware('auth:api');
});

Route::group(['prefix' => 'task', 'middleware' => ['auth:api'], 'namespace' => 'Task'], function () {
    Route::get('/', 'GetTasksController')->name('task.get');
    Route::post('/', 'CreateTaskController')->name('task.create');
    Route::get('{task}', 'GetTaskController')->name('task.get-by-id')->middleware('can:view,task');
    Route::put('{task}', 'UpdateTaskController')->name('task.update')->middleware('can:update,task');
    Route::patch('status/{task}', 'UpdateTaskStatusController')->name('task.update-status')->middleware('can:update,task');
    Route::delete('{task}', 'DeleteTaskController')->name('task.update')->middleware('can:delete,task');
});
