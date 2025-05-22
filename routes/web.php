<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DashboardController;

require __DIR__ . '/auth.php';

Route::group([
    'middleware' => 'auth',
], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/customers', CustomerController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/orders', OrderController::class);
});
