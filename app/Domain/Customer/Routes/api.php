<?php

use App\Domain\Customer\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::prefix('api/customers')
    ->name('customers.')
    ->middleware('api')
    ->group(
        function () {
            Route::post('/', [CustomerController::class, 'store'])->name('store');
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::get('/{customer}', [CustomerController::class, 'show'])->name('show');
            Route::put('/{customer}', [CustomerController::class, 'update'])->name('update');
            Route::delete('/{customer}', [CustomerController::class, 'delete'])->name('delete');
        }
);
