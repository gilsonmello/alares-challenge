<?php

use App\Http\Controllers\Api\OrderController;
use Illuminate\Support\Facades\Route;

Route::resource('orders', OrderController::class, [
    'names' => [
        'index' => 'api.orders.index',
        'create' => 'api.orders.create',
        'store' => 'api.orders.store',
        'edit' => 'api.orders.edit',
        'update' => 'api.orders.update',
        'destroy' => 'api.orders.destroy',
        'show' => 'api.orders.show'
    ]
]);
