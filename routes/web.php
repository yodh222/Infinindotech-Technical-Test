<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

require __DIR__ . '/auth.php';

Route::group([
    'middleware' => 'auth',
], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/customers', CustomerController::class);
    Route::resource('/products', ProductController::class);
});