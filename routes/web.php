<?php

use App\Http\Controllers\LoginController;
use App\src\Infrastructure\Http\Controllers\Customers\EditController;
use App\src\Infrastructure\Http\Controllers\Customers\IndexController;
use App\src\Infrastructure\Http\Controllers\Customers\CreateController;
use App\src\Infrastructure\Http\Controllers\Customers\StoreController;
use App\src\Infrastructure\Http\Controllers\Customers\UpdateController;
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
    Route::get('/create', [CreateController::class, 'create'])->name('create')->middleware('auth');
// Store the newly created customer
    Route::post('/', [StoreController::class, 'store'])->name('store')->middleware('auth');

    // Get all customers
    Route::get('/list', [IndexController::class, 'index'])->name('index')->middleware('auth');

    // Update customer
    Route::put('/{id}', [UpdateController::class, 'update'])->name('update')->middleware('auth');
    Route::get('/{id}/edit', [EditController::class, 'edit'])->name('edit')->middleware('auth');

});


