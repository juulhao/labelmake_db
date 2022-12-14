<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RotuloController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/rotulos', [RotuloController::class, 'getRotulos']);
Route::get('/pdf', [RotuloController::class, 'getPDF']);

Route::get('/pdfteste', function () {
    return view('Bisnagas/AF_B5.template');
});
