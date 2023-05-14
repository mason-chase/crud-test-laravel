<?php

use App\Http\Controllers\LoginController;
use Ddd\Infrastructure\Http\Controllers\Customers\CreateController;
use Ddd\Infrastructure\Http\Controllers\Customers\DeleteController;
use Ddd\Infrastructure\Http\Controllers\Customers\EditController;
use Ddd\Infrastructure\Http\Controllers\Customers\IndexController;
use Ddd\Infrastructure\Http\Controllers\Customers\StoreController;
use Ddd\Infrastructure\Http\Controllers\Customers\UpdateController;
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


Route::middleware(['auth'])->prefix('customers')->as('customers.')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::get('/create', [CreateController::class, 'create'])->name('create');
    Route::post('/', [StoreController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [EditController::class, 'edit'])->name('edit');
    Route::put('/{id}', [UpdateController::class, 'update'])->name('update');
    Route::delete('/{id}', [DeleteController::class, 'destroy'])->name('destroy');
});


