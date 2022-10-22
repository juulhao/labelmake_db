<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login.api');
    Route::post('/register', [AuthController::class, 'register'])->name('register.api');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.api');
    Route::get('/rotulos', [RotuloController::class, 'getRotulos']);
    Route::get('/pdf', [RotuloController::class, 'getPDF']);
});
