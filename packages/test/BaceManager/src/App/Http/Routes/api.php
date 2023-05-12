<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => config('BaceManager.api_prefix'),
    'middleware' => config('BaceManager.api_middleware')
], function () {

    

});