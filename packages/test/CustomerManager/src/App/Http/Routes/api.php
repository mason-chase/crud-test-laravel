<?php

use Illuminate\Support\Facades\Route;
use Test\CustomerManager\App\Http\Controllers\Api\CustomerApiController;

Route::group(config('BaceManager.bace_api_route'), function () {

    Route::controller(CustomerApiController::class)
    ->prefix('customer')
    ->name('customer.')
    ->group(function(){
        Route::get('', 'index')->name('index');

        // Route::middleware('auth:sanctum')->group(function() {
            Route::post('', 'store')->name('store');
            Route::put('{customer}', 'update')->name('update');
            Route::delete('', 'destroy')->name('destroy');
        // });
        
    });

    

});