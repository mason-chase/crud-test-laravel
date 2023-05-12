<?php

use Illuminate\Support\Facades\Route;
use Test\CustomerManager\App\Http\Controllers\CustomerController;

Route::group([
    'prefix' => config('BaceManager.api_prefix'),
    'middleware' => config('BaceManager.api_middleware')
], function () {


    Route::controller(CustomerController::class)
    ->prefix('customer')
    ->name('customer')
    ->group(function(){
        Route::get('', 'index')->name('index');
        Route::post('', 'store')->name('store');
        Route::get('{customer}', 'show')->middleware('auth')->name('show');
        Route::put('{customer}', 'update')->middleware('auth')->name('update');
        Route::delete('', 'destroy')->middleware('auth')->name('destroy');
    });

    

});