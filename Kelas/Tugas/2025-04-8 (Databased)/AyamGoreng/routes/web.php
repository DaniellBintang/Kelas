<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;

Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Routes untuk Menu
Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu.index');

// Routes untuk Cart
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

// Routes untuk Order
Route::get('/order/direct/{menu_id}', [OrderController::class, 'directOrder'])->name('order.direct');
Route::get('/checkout', [OrderController::class, 'checkoutIndex'])->name('checkout.index');
Route::post('/checkout/process', [OrderController::class, 'processCheckout'])->name('checkout.process');
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');

Route::get('/menu', [MenuController::class, 'index']);
// Route ke AyamController
Route::get('/', [PageController::class, 'home']);
Route::get('/order', [PageController::class, 'order']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/chat', [PageController::class, 'chat']);


// Routes untuk Cart (hanya bisa diakses oleh pengguna yang login)
Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Routes untuk Order
    Route::get('/order/direct/{menu_id}', [OrderController::class, 'directOrder'])->name('order.direct');
    Route::get('/checkout', [OrderController::class, 'checkoutIndex'])->name('checkout.index');
    Route::post('/checkout/process', [OrderController::class, 'processCheckout'])->name('checkout.process');
});

// Route untuk halaman sukses order (hanya bisa diakses oleh pengguna yang login)
Route::get('/order/success', [OrderController::class, 'success'])->name('order.success')->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup']);
});

// Route untuk halaman Profile (hanya bisa diakses oleh pengguna yang login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});

Route::middleware('auth')->group(function () {
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
});

// Add these routes to your web.php routes file

// Profile routes
Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
Route::post('/profile/avatar', [App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
