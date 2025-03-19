<?php

use App\Infrastructure\Controllers\ProductController;
use App\Infrastructure\Controllers\CartController;
use App\Infrastructure\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    // Cart Routes
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/', [CartController::class, 'addItem'])->name('cart.store');
        Route::put('{cartItemId}', [CartController::class, 'updateItem'])->name('cart.update');
        Route::delete('empty', [CartController::class, 'emptyCart'])->name('cart.empty');
        Route::delete('{cartItemId}', [CartController::class, 'removeItem'])->name('cart.destroy');
    });

    // Product Routes
    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::post('/', [ProductController::class, 'store'])->name('products.store');
        Route::get('{id}', [ProductController::class, 'show'])->name('products.show');
        Route::put('{id}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    });
});

// Authentication Routes
Route::post('login', [AuthController::class, 'login']);
