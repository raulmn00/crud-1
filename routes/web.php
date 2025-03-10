<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UsersController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/${id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::post('/products/${id}', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/${id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/${id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/${id}', [ProductController::class, 'delete'])->name('products.delete');

// Rotas de autenticação
Route::get('/register', [UsersController::class, 'showRegister'])->name('register');
Route::post('/register', [UsersController::class, 'register'])->name('user.register');

Route::get('/login', [UsersController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/password/request', [UsersController::class, 'showPasswordRequest'])->name('password.request');
Route::post('/password/email', [UsersController::class, 'passwordRequest'])->name('password.email');
