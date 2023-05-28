<?php

use Domains\Customer\Http\Controllers\CustomerController;
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

Route::prefix('api')->group(function () {
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customers.show');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
});
