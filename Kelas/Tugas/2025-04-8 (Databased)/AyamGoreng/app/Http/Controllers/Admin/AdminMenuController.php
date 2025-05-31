<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMenuController extends Controller
{
    /**
     * Tampilkan daftar menu.
     */
    public function index(Request $request)
    {
        $query = Menu::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('price', 'LIKE', "%{$search}%");
            });
        }

        // Filter by price
        if ($request->has('filter')) {
            switch ($request->filter) {
                case 'price_high':
                    $query->orderBy('price', 'desc');
                    break;
                case 'price_low':
                    $query->orderBy('price', 'asc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
            }
        }

        $menus = $query->paginate(12)->withQueryString();

        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Tampilkan form untuk menambahkan menu baru.
     */
    public function create()
    {
        return view('admin.menus.create');
    }

    /**
     * Simpan menu baru ke database.
     */
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

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    /**
     * Tampilkan form untuk mengedit menu.
     */
    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update menu di database.
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        $menu->fill($request->all());
        if ($request->hasFile('image')) {
            $menu->image = $request->file('image')->store('menus', 'public');
        }
        $menu->save();

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    /**
     * Hapus menu dari database.
     */
    public function destroy(Menu $menu)
    {
        $menu->delete();
        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil dihapus.');
    }
}
