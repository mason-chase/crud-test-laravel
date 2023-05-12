<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
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


Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::prefix('customers')->as('customers.')->group(function () {
// Show the create customer form
    Route::get('/create', [CustomerController::class, 'showCreate'])->name('create.show')->middleware('auth');

// Store the newly created customer
    Route::post('/', [CustomerController::class, 'store'])->name('store');
});


