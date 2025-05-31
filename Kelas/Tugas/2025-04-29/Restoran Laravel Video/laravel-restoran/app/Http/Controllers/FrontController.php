<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Menu;

class FrontController extends Controller
{
    public function index()
    {
        $menus = Menu::with('kategori')->paginate(9);
        $kategoris = Kategori::all();
        return view('front.index', compact('menus', 'kategoris'));
    }

    public function menu()
    {
        // Menampilkan daftar menu
        // $menus = Menu::all();
        // return view('front.menu', compact('menus'));
        return view('front.menu');
    }

    public function kategori()
    {
        // Menampilkan daftar kategori
        // $kategoris = Kategori::all();
        // return view('front.kategori', compact('kategoris'));
        return view('front.kategori');
    }

    public function cart()
    {
        // Menampilkan halaman keranjang
        return view('front.cart');
    }
}
