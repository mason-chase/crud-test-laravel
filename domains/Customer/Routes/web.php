<?php

use Domains\Customer\Http\Controllers\Web\CustomerController;
use Illuminate\Support\Facades\Route;

Route::resource('/customers', CustomerController::class);
