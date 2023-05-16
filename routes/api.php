<?php

use App\Http\Controllers\Customers\CustomerController;
use App\Http\Controllers\Customers\GetAllCustomerController;
use App\Http\Controllers\Customers\ShowCustomerController;
use App\Http\Controllers\Customers\StoreCustomerController;
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

Route::prefix('customers')->group(callback: static function () {
    Route::get(uri: '/', action: GetAllCustomerController::class);
    Route::get(uri: '/{id}', action: ShowCustomerController::class);
    Route::post(uri: '/', action: StoreCustomerController::class);
});
