<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\UserController;
use App\http\Controllers\AdminController;
use App\http\Controllers\ItemController;

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('redirectIfAuthenticated');

// Show Register Form
Route::get('/register', [UserController::class, 'register'])->middleware('redirectIfAuthenticated');

// Store New User
Route::post('/user/store', [UserController::class, 'store']);

// Authenticate User
Route::post('/authenticate', [UserController::class, 'authenticate']);

// Admin Dashboard
Route::get('/admin', [ItemController::class, 'admin_index'])->middleware('auth')->middleware('isadmin');

// Log user out
Route::post('/logout', [UserController::class, 'logout']);

// Show User all Items
Route::get('/', [ItemController::class, 'index']);

// Create Item
Route::put('/admin/update/{id}')->middleware('auth')->middleware('isadmin');

// Delete Item
Route::delete('/admin/delete/{id}')->middleware('auth')->middleware('isadmin');