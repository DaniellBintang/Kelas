<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AyamController;


Route::get('/', function () {
    return view('home');
});

Route::get('/sekolah', function () {
    return view('home-sekolah');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/major', function () {
    return view('major');
});

// Route ke AyamController
Route::get('/ayam', [AyamController::class, 'home']);
Route::get('/menu', [AyamController::class, 'menu']);
Route::get('/order', [AyamController::class, 'order']);
Route::get('/contact-ayam', [AyamController::class, 'contact']);
Route::get('/chat', [AyamController::class, 'chat']);
Route::get('/cart', [AyamController::class, 'cart']);
Route::get('/menu/ayam-original', function () {
    return view('menu.ayam-original');
})->name('menu.ayam-original');
Route::get('/menu/ayam-telurasin', function () {
    return view('menu.ayam-telurasin');
})->name('menu.ayam-telurasin');
Route::get('/menu/ayam-potong', function () {
    return view('menu.ayam-potong');
})->name('menu.ayam-potong');
