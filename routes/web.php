<?php

use App\Http\Controllers\CustomerController;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

require __DIR__ . '/auth.php';

Route::group([
    'middleware' => 'auth',
], function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/customers', CustomerController::class);
});