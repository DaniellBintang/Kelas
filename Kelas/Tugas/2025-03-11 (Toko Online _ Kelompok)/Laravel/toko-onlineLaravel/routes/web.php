<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RatingAdminController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactCustomerController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderHistoryController;

// Public routes (accessible without login)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/ratings', [RatingController::class, 'index'])->name('ratings');
Route::get('/ratings/{id}', [RatingController::class, 'show'])->name('ratings.show');
Route::get('/about', [AboutController::class, 'index'])->name('about');

// Customer Authentication Routes
Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [CustomerAuthController::class, 'login']);
Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [CustomerAuthController::class, 'register']);
Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('logout');

// Protected Customer Routes (require login)
Route::middleware('customer.auth')->group(function () {
    // Shop routes
    Route::get('/shop', [ShopController::class, 'index'])->name('shop');
    Route::post('/shop/add-to-cart', [ShopController::class, 'addToCart'])->name('shop.addToCart');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Cart routes
    Route::post('/add-to-cart', [HomeController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    // Contact routes
    Route::get('/contact', [ContactCustomerController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactCustomerController::class, 'store'])->name('contact.store');

    Route::get('/order-history', [OrderHistoryController::class, 'index'])->name('order-history');
    Route::post('/order-history/submit-review', [OrderHistoryController::class, 'submitReview'])->name('order-history.submit-review');

    // Checkout route
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
});

// Admin Auth Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Admin Protected Routes
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Resource routes for each section
    Route::resource('products', ProductController::class);
    Route::resource('banners', BannerController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('ratings', RatingAdminController::class);
    Route::resource('users', UserController::class);

    // Contact messages routes
    Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{id}', [ContactController::class, 'show'])->name('contacts.show');
    Route::patch('/contacts/{id}/mark-read', [ContactController::class, 'markAsRead'])->name('contacts.mark-read');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    // API-like endpoints for AJAX requests
    Route::get('/orders/{id}/details', [OrderController::class, 'getOrderDetails'])->name('orders.details');
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
});
