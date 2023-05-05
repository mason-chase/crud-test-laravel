<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

Route::get('/login', function(){
    return response()->json(['errors' => 'Not in the scope of the current project'], Response::HTTP_NOT_ACCEPTABLE);
})->name('login');
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customer.store');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customer.update');
});
