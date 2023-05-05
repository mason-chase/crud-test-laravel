<?php
use Domains\Customer\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::prefix('api')->group(function() {
  Route::middleware('auth:sanctum')->group(function(){
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customer.delete');
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customer.show');
  });
});