<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentMethodController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;

Route::prefix('transactions')->group(function() {
    Route::get('/', [TransactionController::class, 'index']);
    Route::get('{id}', [TransactionController::class, 'show']);
    Route::post('/', [TransactionController::class, 'store']);
    Route::put('{id}', [TransactionController::class, 'update']);
    Route::delete('{id}', [TransactionController::class, 'destroy']);
});

Route::prefix('categories')->group(function() {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('{id}', [CategoryController::class, 'show']);
    Route::post('/', [CategoryController::class, 'store']);
    Route::put('{id}', [CategoryController::class, 'update']);
    Route::delete('{id}', [CategoryController::class, 'destroy']);
});

Route::prefix('payment-methods')->group(function() {
    Route::get('/', [PaymentMethodController::class, 'index']);
    Route::get('{id}', [PaymentMethodController::class, 'show']);
    Route::post('/', [PaymentMethodController::class, 'store']);
    Route::put('{id}', [PaymentMethodController::class, 'update']);
    Route::delete('{id}', [PaymentMethodController::class, 'destroy']);
});
