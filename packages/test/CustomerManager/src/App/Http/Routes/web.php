<?php

use Illuminate\Support\Facades\Route;
use Test\CustomerManager\App\Http\Controllers\Web\CustomerWebController;

Route::name('web.')->group(function() {

    Route::controller(CustomerWebController::class)
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