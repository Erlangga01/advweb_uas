<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AxlController;

use App\Http\Controllers\Api\ProductController;
// Use the root controllers which were recently updated to return JSON
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\TransactionController;


// Public Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/materials', [MaterialController::class, 'index']);

    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::get('/transactions/{id}', [AxlController::class, 'getTransaction']);
    Route::post('/transactions', [TransactionController::class, 'store']);
});