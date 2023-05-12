<?php

use Ddd\Application\Customer\Service\CustomerService;
use Illuminate\Http\Request;
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

// Disable authentication
//Route::group(['middleware' => ['auth:sanctum']], function () {
//    Route::prefix('customers')->as('customers.')->group(function () {
//        Route::post('/', [CustomerService::class, 'createCustomer'])->name('create');
//        Route::get('/{id}', [CustomerService::class, 'getCustomerById'])->name('get.id');
//        Route::put('/{id}', [CustomerService::class, 'updateCustomer'])->name('update');
//        Route::delete('/{id}', [CustomerService::class, 'deleteCustomer'])->name('delete');
//    });
//});
