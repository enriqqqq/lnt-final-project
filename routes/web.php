<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\UserController;

// Show Login Form
Route::get('/', [UserController::class, 'login']);

// Show Register Form
Route::get('/register', [UserController::class, 'register']);

// Store New User
Route::post('/user/store', [UserController::class, 'store']);

// Authenticate User
Route::post('/authenticate', [UserController::class, 'authenticate']);

Route::get('/welcome', function () {
    return view('welcome');
})->middleware('isadmin');

// Log user out
Route::post('/logout', [UserController::class, 'logout']);
