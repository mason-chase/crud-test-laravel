<?php

use Illuminate\Support\Facades\Route;
use Src\Customer\Presentation\Controllers\CustomerController;


Route::prefix('customers')
    ->name('customers.')
    ->group(function () {
        Route::resource('', CustomerController::class);
    });
