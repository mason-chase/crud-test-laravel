<?php

use Illuminate\Support\Facades\Route;
use Test\CustomerManager\App\Http\Controllers\Web\CustomerWebController;

Route::group(config('BaceManager.bace_web_route'), function () {
    
    Route::resource('customer', CustomerWebController::class);

});