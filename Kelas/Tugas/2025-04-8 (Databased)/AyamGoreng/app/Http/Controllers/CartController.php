<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class CartController extends Controller
{
    /**
     * Display the cart page
     */
    public function index()
    {
        return view('cart');
    }

    /**
     * Add an item to the cart
     */
    public function add(Request $request)
    {
        $request->validate([
            'menu_id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $menu = Menu::findOrFail($request->menu_id);
        $cart = session()->get('cart', []);

        // Cek apakah menu sudah ada di keranjang
        if (isset($cart[$menu->id])) {
            $cart[$menu->id]['quantity'] += $request->quantity;
        } else {
            $cart[$menu->id] = [
                'name' => $menu->name,
                'quantity' => $request->quantity,
                'price' => $menu->price,
                'image' => $menu->image,
                'description' => $menu->description
            ];
        }

        session()->put('cart', $cart);

        return response()->json(['success' => true, 'cartCount' => count($cart)]);
    }

    /**
     * Update the quantity for a cart item
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:menus,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Remove an item from the cart
     */
    public function remove(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:menus,id',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Clear the entire cart
     */
    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang berhasil dikosongkan!');
    }
}
