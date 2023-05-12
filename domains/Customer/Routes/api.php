<?php

use Domains\Customer\Http\Controllers\Api\CustomerController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/v1')->group(function () {
    Route::resource('/customer', CustomerController::class);
});