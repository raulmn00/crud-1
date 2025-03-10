<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('/products/${id}', [ProductController::class, 'show'])->name('products.show');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::post('/products/${id}', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/${id}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/products/${id}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/${id}', [ProductController::class, 'delete'])->name('products.delete');
