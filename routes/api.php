<?php

use App\Http\Controllers\Customers\CustomerController;
use App\Http\Controllers\Customers\DeleteCustomerController;
use App\Http\Controllers\Customers\GetAllCustomerController;
use App\Http\Controllers\Customers\ShowCustomerController;
use App\Http\Controllers\Customers\StoreCustomerController;
use App\Http\Controllers\Customers\UpdateCustomerController;
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

Route::prefix('customers')->name('customers.')->group(callback: static function () {
    Route::get(uri: '/', action: GetAllCustomerController::class)->name('index');
    Route::get(uri: '/{id}', action: ShowCustomerController::class)->name('show');
    Route::post(uri: '/', action: StoreCustomerController::class)->name('store');
    Route::put(uri: '/{id}', action: UpdateCustomerController::class)->name('update');
    Route::delete(uri: '/{id}', action: DeleteCustomerController::class)->name('delete');
});
