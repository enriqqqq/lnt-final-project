<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\UserController;
use App\http\Controllers\AdminController;
use App\http\Controllers\ItemController;
use App\http\Controllers\CategoryController;
use App\http\Controllers\CartController;
use App\http\Controllers\OrderController;
use App\Models\Order;

// Show Login Form
Route::get('/login', [UserController::class, 'login'])->name('login')
    ->middleware('redirectIfAuthenticated');

// Show Register Form
Route::get('/register', [UserController::class, 'register'])
    ->middleware('redirectIfAuthenticated');

// Store New User
Route::post('/user/store', [UserController::class, 'store']);

// Authenticate User
Route::post('/authenticate', [UserController::class, 'authenticate']);

// Admin Dashboard
Route::get('/admin', [ItemController::class, 'admin_index'])
    ->middleware('auth')
    ->middleware('isadmin');

// Log user out
Route::post('/logout', [UserController::class, 'logout']);

// Show User all Items
Route::get('/', [ItemController::class, 'index'])->name('dashboard');

// Show Create Item Form
Route::get('/admin/items/create', [ItemController::class, 'create']);

// Store Item
Route::post('/admin/items', [ItemController::class, 'store'])
    ->middleware('auth')
    ->middleware('isadmin');

// Update Item
Route::put('/admin/items/update/{item}', [ItemController::class, 'update'])
    ->middleware('auth')
    ->middleware('isadmin');

// Delete Item
Route::delete('/admin/items/delete/{item}', [ItemController::class, 'destroy'])
    ->middleware('auth')
    ->middleware('isadmin');

// Store Category
Route::post('/admin/categories', [CategoryController::class, 'store'])
    ->middleware('auth')
    ->middleware('isadmin');

// Update Category
Route::put('/admin/categories/update/{category}', [CategoryController::class, 'update'])
    ->middleware('auth')
    ->middleware('isadmin');

// Delete Category
Route::delete('/admin/categories/delete/{category}', [CategoryController::class, 'destroy'])
    ->middleware('auth')
    ->middleware('isadmin');

// Add to Cart
Route::post('/carts/{user}/{item}', [CartController::class, 'addToCart'])
    ->middleware('auth');

// Update Cart
Route::put('/carts/update/{cart}', [CartController::class, 'update'])
    ->middleware('auth');

// Delete Cart
Route::delete('/carts/delete/{cart}', [CartController::class, 'destroy'])
    ->middleware('auth');

// Show Check Out Page
Route::get('/checkout', [CartController::class, 'checkout'])
    ->middleware('auth');

// Store Checkout Info
Route::post('/checkout/{user}', [CartController::class, 'store'])
    ->middleware('auth');

// Show ALl Orders
Route::get('/admin/invoice/all', [OrderController::class, 'all'])
    ->middleware('auth')
    ->middleware('isadmin');

// Download Invoice
Route::get('/invoice/download/{order}', [OrderController::class, 'download'])
    ->middleware('auth');

// Show Order History
Route::get('/invoice/{user}/all', [OrderController::class, 'index'])
    ->middleware('auth');

// Update User
Route::put('/users/update/{user}', [UserController::class, 'update'])
    ->middleware('auth');

// Show Checkout Info
Route::get('/invoice/{user}/{order}', [OrderController::class, 'show'])
    ->middleware('auth');

// Show Profile
Route::get('/users/{user}', [UserController::class, 'show'])
    ->middleware('auth');