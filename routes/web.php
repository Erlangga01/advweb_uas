<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TransactionController;

Route::get('/', [TransactionController::class, 'create'])->name('home');

Route::get('/inventory', [MaterialController::class, 'index'])->name('inventory.index');

Route::get('/sales', [TransactionController::class, 'index'])->name('sales.index');
Route::post('/sales', [TransactionController::class, 'store'])->name('sales.store');
// Route::delete('/sales/{id}', [TransactionController::class, 'destroy'])->name('sales.destroy');
