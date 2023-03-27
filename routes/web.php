<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\UserController;

// Show Login Form
Route::get('/', [UserController::class, 'login']);

Route::post('/authenticate', [UserController::class, 'authenticate']);

Route::get('/welcome', function () {
    return view('welcome');
})->middleware('isadmin');

Route::post('/logout', [UserController::class, 'logout']);
