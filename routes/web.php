<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\UserController;
use App\http\Controllers\AdminController;
use App\http\Controllers\ItemController;

// Show Login Form
Route::get('/', [UserController::class, 'login']);

// Show Register Form
Route::get('/register', [UserController::class, 'register']);

// Store New User
Route::post('/user/store', [UserController::class, 'store']);

// Authenticate User
Route::post('/authenticate', [UserController::class, 'authenticate']);

// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware('isadmin');

// User Dashboard
Route::get('/user/dashboard', [ItemController::class, 'index']);

// Log user out
Route::post('/logout', [UserController::class, 'logout']);