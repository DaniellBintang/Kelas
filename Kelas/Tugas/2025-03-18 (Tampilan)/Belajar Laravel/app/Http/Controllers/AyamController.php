<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AyamController extends Controller
{
    // Halaman Cart
    public function cart()
    {
        // Dummy data untuk keranjang belanja
        $cartItems = [
            [
                'image' => 'images/ayamgoreng.jpg',
                'name' => 'Ayam Goreng',
                'price' => 20000,
                'quantity' => 2,
                'total' => 40000,
            ],
            [
                'image' => 'images/ayamkremes.jpg',
                'name' => 'Ayam Kremes',
                'price' => 23000,
                'quantity' => 1,
                'total' => 23000,
            ],
        ];

        // Total harga semua item
        $cartTotal = array_sum(array_column($cartItems, 'total'));

        // Mengembalikan view dengan data
        return view('cart', compact('cartItems', 'cartTotal'));
    }

    // Halaman Home Ayam
    public function home()
    {
        return view('home-ayam');
    }

    // Halaman Menu
    public function menu()
    {
        return view('menu');
    }

    // Halaman Order
    public function order()
    {
        return view('order');
    }

    // Halaman Contact Ayam
    public function contact()
    {
        return view('contact-ayam');
    }

    // Halaman Chat
    public function chat()
    {
        return view('chat');
    }
}
