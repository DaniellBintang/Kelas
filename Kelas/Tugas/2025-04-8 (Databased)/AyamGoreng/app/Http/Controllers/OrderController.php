<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Direct order for a specific menu
     */
    public function directOrder($menu_id)
    {
        $menu = Menu::findOrFail($menu_id);

        // Kosongkan keranjang dan tambahkan hanya satu item
        $cart = [];
        $cart[$menu->id] = [
            'name' => $menu->name,
            'quantity' => 1,
            'price' => $menu->price,
            'image' => $menu->image,
            'description' => $menu->description
        ];

        session()->put('cart', $cart);

        return redirect()->route('checkout.index');
    }

    /**
     * Display the checkout page
     */
    public function checkoutIndex()
    {
        // Cek apakah keranjang kosong
        if (!session()->has('cart') || count(session('cart')) == 0) {
            return redirect()->route('menu.index')->with('error', 'Keranjang Anda kosong!');
        }

        return view('checkout');
    }

    /**
     * Process the checkout
     */
    public function processCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
            'payment_method' => 'required|string|in:cash,transfer'
        ]);

        $cart = session('cart', []);
        $totalPrice = array_reduce($cart, function ($total, $item) {
            return $total + ($item['price'] * $item['quantity']);
        }, 0);

        // Simpan pesanan ke database
        Order::create([
            'user_id' => Auth::id(), // Pastikan Auth::id() digunakan dengan benar
            'items' => json_encode($cart), // Simpan detail pesanan dalam format JSON
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Kosongkan keranjang setelah checkout berhasil
        session()->forget('cart');

        return redirect()->route('order.success')->with('success', 'Pesanan Anda berhasil diproses!');
    }

    /**
     * Display order success page
     */
    public function success()
    {
        return view('order.success');
    }
}
