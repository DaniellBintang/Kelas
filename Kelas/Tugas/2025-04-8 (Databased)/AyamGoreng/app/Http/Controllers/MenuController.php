<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menu', compact('menus'));
        return view('admin.menus.index', compact('menus'));
    }

    public function create()
    {
        return view('admin.menus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $menu = new Menu($request->all());
        if ($request->hasFile('image')) {
            $menu->image = $request->file('image')->store('menus', 'public');
        }
        $menu->save();

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }
}
