<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\KategoriController;

// Frontend routes
Route::get('/', [FrontController::class, 'index']);
Route::get('/menu', [FrontController::class, 'menu']);
Route::get('/cart', [FrontController::class, 'cart']);

// Authentication routes
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/postregister', [RegisterController::class, 'store']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/postlogin', [LoginController::class, 'postlogin']);
Route::get('/logout', [LoginController::class, 'logout']);


Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::get('add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::patch('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

Route::post('checkout', [CartController::class, 'checkout'])->name('cart.checkout');
// Pastikan route ini ada dan benar
Route::get('order/success/{id}', [CartController::class, 'orderSuccess'])->name('order.success');

// Menu & Kategori routes
Route::get('/menu', [MenuController::class, 'index']);
Route::get('/kategori/{id}', [MenuController::class, 'showByKategori']);
