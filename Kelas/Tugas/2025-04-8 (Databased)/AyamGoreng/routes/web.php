<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminContactController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;

// Public routes

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');

// Customer Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup']);
});

// Customer Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/contact', [PageController::class, 'contact'])->name('contact');
    Route::post('/contact/store', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/chat', [PageController::class, 'chat']);
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    // Profile routes
    Route::get('/profile/edit', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/avatar', [App\Http\Controllers\ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');

    // Cart routes
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Order routes
    Route::get('/order/direct/{menu_id}', [OrderController::class, 'directOrder'])->name('order.direct');
    Route::get('/checkout', [OrderController::class, 'checkoutIndex'])->name('checkout.index');
    Route::post('/checkout/process', [OrderController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/order/success', [OrderController::class, 'success'])->name('order.success');
});

// Routes untuk admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Login routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');

    // Dashboard dan halaman admin lainnya
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Perbaikan route logout - hapus prefix '/admin/' karena sudah ada di grup Route::prefix('admin')
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::resource('menus', \App\Http\Controllers\Admin\AdminMenuController::class);

    // Add this inside the admin routes group
    Route::resource('users', \App\Http\Controllers\Admin\AdminUserController::class);

    // Routes untuk orders
    Route::get('/orders', [\App\Http\Controllers\Admin\AdminOrderController::class, 'index'])->name('orders.index');
    Route::patch('/orders/{order}/status', [\App\Http\Controllers\Admin\AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    Route::get('/contacts', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');

    // Tambahkan route admin lainnya di sini
});

// ... existing code ...

// Admin User Management Routes
Route::prefix('admin/users')->name('admin.users.')->middleware(['auth:admin'])->group(function () {
    // ... existing routes ...

    // Admin management
    Route::get('/edit-admin/{id}', [AdminUserController::class, 'editAdmin'])->name('edit-admin');
    Route::put('/update-admin/{id}', [AdminUserController::class, 'updateAdmin'])->name('update-admin');
    Route::delete('/destroy-admin/{id}', [AdminUserController::class, 'destroyAdmin'])->name('destroy-admin');
});
Route::post('/admin/users/store-admin', [AdminUserController::class, 'storeAdmin'])->name('admin.users.store-admin');


// ... existing code ...
