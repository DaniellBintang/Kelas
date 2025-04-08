<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Halaman Home Ayam
    public function home()
    {
        return view('home');
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
        return view('contact');
    }

    // Halaman Chat
    public function chat()
    {
        return view('chat');
    }
}
