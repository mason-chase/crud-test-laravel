<?php

use Illuminate\Support\Facades\Route;
use Src\Customer\Presentation\Controllers\CustomerController;


Route::prefix('customers')
    ->name('customers.')
    ->group(function () {
        Route::get('index', [CustomerController::class, 'index']);
        Route::get('{id}', [CustomerController::class, 'show']);
        Route::post('', [CustomerController::class, 'store']);
        Route::put('{id}', [CustomerController::class, 'update']);
        Route::delete('{id}', [CustomerController::class, 'destroy']);
    });
