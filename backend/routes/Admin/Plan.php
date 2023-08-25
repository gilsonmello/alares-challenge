<?php

use App\Http\Controllers\Admin\PlanController;
use Illuminate\Support\Facades\Route;

Route::resource('plans', PlanController::class, [
    'names' => [
        'index' => 'admin.plans.index',
        'create' => 'admin.plans.create',
        'store' => 'admin.plans.store',
        'edit' => 'admin.plans.edit',
        'update' => 'admin.plans.update',
        'destroy' => 'admin.plans.destroy',
        'show' => 'admin.plans.show'
    ]
]);
