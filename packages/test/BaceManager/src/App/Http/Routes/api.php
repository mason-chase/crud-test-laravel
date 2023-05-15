<?php

use Illuminate\Support\Facades\Route;
use Test\BaceManager\App\Http\Controllers\AuthController;

Route::group(config('BaceManager.bace_api_route'), function () {

    Route::controller(AuthController::class)
    ->prefix('auth')
    ->name('auth.')
    ->group(function(){
        Route::post('login', 'login')->name('login');
        Route::post('register', 'register')->name('register');
        Route::post('forgot-password', 'forgotpassword')->name('forgotpassword');
    });
    

});