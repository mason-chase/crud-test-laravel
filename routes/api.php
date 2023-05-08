<?php

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
Route::prefix('v1')->group(function () {
	Route::prefix('customer')->group(function () {
		Route::get('',[\App\Http\Controllers\V1\Customer\CustomerController::class, 'index']);
		Route::post('',[\App\Http\Controllers\V1\Customer\CustomerController::class, 'store']);
		Route::get('{id}',[\App\Http\Controllers\V1\Customer\CustomerController::class, 'single']);
		Route::delete('{id}',[\App\Http\Controllers\V1\Customer\CustomerController::class, 'delete']);
		Route::patch('{id}',[\App\Http\Controllers\V1\Customer\CustomerController::class, 'patch']);
	});
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
