<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RotuloController;

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['cors', 'json.response']], function () {
    Route::get('/health-check', function () {
        return response('Is alive');
    });
    Route::post('/login', [AuthController::class, 'login'])->name('login.api');
    Route::post('/register', [AuthController::class, 'register'])->name('register.api');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout.api');
    Route::post('/rotulos', [RotuloController::class, 'getRotulos']);
    Route::post('/anexos', [RotuloController::class, 'getAnexos']);
    Route::get('/pdf', [RotuloController::class, 'makePDF']);
    Route::post('/create-rotulo', [RotuloController::class, 'createRotulo']);
});
