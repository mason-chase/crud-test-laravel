<?php

use Ddd\Application\Customer\Service\CustomerService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::prefix('customers')->as('customers.')->group(function () {
// Show the create customer form
    Route::get('/create', [CustomerService::class, 'showCreateCustomer'])->name('create.show');

// Store the newly created customer
    Route::post('/customers', [CustomerService::class, 'createCustomer'])->name('create');

});


