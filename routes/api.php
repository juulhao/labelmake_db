<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RotuloController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login.api');
    Route::post('/register', [AuthController::class, 'register'])->name('register.api');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.api');
    Route::post('/rotulos', [RotuloController::class, 'getRotulos']);
    Route::post('/pdf', [RotuloController::class, 'getPDF']);
});
