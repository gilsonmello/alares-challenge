<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;

Route::get('/login', [LoginController::class, 'index'])
    ->name('admin.login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', 'Admin\LoginController@logout')->name('admin.postLogout');
Route::get('/logout', 'Admin\LoginController@getLogout')->name('admin.getLogout');
