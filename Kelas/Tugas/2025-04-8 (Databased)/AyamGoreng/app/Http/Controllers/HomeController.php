<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama.
     */
    public function index()
    {
        // Ambil 3 menu unggulan dari database
        $featuredMenus = Menu::take(3)->get();

        // Kirim data ke view
        return view('home', compact('featuredMenus'));
    }
}
