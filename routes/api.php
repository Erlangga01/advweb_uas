<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AxlController;

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\TransactionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/products', [ProductController::class, 'index']);
Route::get('/materials', [MaterialController::class, 'index']);
Route::post('/transactions', [TransactionController::class, 'store']);



Route::get('/products', [AxlController::class, 'getProducts']);
Route::get('/materials', [AxlController::class, 'getMaterials']);
Route::get('/transactions', [AxlController::class, 'getTransactions']);
Route::post('/transactions', [AxlController::class, 'storeTransaction']);