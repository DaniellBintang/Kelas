<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Kategori;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function showByKategori($id)
    {
        $menus = Menu::where('idkategori', $id)->paginate(8);
        $kategori = Kategori::find($id);
        $kategoris = Kategori::all(); // Tambahkan ini untuk mendapatkan semua kategori

        return view('kategori', [
            'menus' => $menus,
            'kategori' => $kategori,
            'kategoris' => $kategoris // Tambahkan ini ke array
        ]);
    }
}
