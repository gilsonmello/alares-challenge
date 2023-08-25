<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Rota para login administrativo
Route::group(['prefix' => 'admin', 'middleware' => 'guest'], function() {
    require __DIR__ . "/Admin/Login.php";
});

Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin.redirect',
], function() {
    require __DIR__ . "/Admin/Plan.php";
    require __DIR__ . "/Admin/Order.php";
});

