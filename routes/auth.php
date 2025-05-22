<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::group([
    'middleware' => 'guest',
], function () {
    Route::get('/', function () {
        return redirect('login');
    })->name('home');
    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('post.login');
});
Route::get('logout', function () {
    Auth::logout();
    return redirect('login');
})->middleware('auth')->name('logout');
