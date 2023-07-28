<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RepeatOrderController;
use App\Http\Controllers\TransactionController;
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

// auth
Route::get('login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate')->middleware('guest');
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('register', [RegistrerController::class, 'index'])->name('register')->middleware('guest');
Route::post('register', [RegistrerController::class, 'store'])->name('register.store')->middleware('guest');



Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::prefix('/transaction')->middleware('auth')->group(function(){
    Route::get('/', [TransactionController::class, 'index'])->name('transaction');
    Route::get('/delete', [TransactionController::class, 'deleteAll'])->name('transaction.turncate');
    Route::delete('/delete/{id}', [TransactionController::class, 'delete'])->name('transaction.delete');
    Route::get('/import', [TransactionController::class, 'import'])->name('transaction.import');
    Route::post('/import', [TransactionController::class, 'storeImport'])->name('transaction.import');
});

Route::prefix('/repeat-order')->middleware('auth')->group(function(){
    Route::get('/', [RepeatOrderController::class, 'index'])->name('repeat-order');
    Route::get('/store', [RepeatOrderController::class, 'store'])->name('repeat-order.store');
    Route::get('/export', [RepeatOrderController::class, 'export'])->name('repeat-order.export');
    Route::get('/detail/{cif}', [RepeatOrderController::class, 'detailCif'])->name('repeat-order.detail-cif');
});

