<?php
// app/Http/Controllers/CartController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display the cart page.
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $total = 0;

        // Get product details for each cart item
        if (!empty($cart)) {
            foreach ($cart as $id => $quantity) {
                $product = Product::find($id);
                if ($product) {
                    $subtotal = $product->price * $quantity;
                    $cartItems[] = [
                        'id' => $id,
                        'product' => $product,
                        'quantity' => $quantity,
                        'subtotal' => $subtotal
                    ];
                    $total += $subtotal;
                }
            }
        }

        // Get cart quantity for badge
        $cartTotalQuantity = array_sum($cart);

        return view('cart', compact('cartItems', 'total', 'cartTotalQuantity'));
    }

    /**
     * Update cart quantities.
     */
    public function update(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = (int) $request->input('quantity');

        // Get current cart
        $cart = Session::get('cart', []);

        // Update quantity or remove if zero
        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId] = $quantity;
        }

        // Save updated cart back to session
        Session::put('cart', $cart);

        return redirect()->route('cart.index')
            ->with('success', 'Cart updated successfully!');
    }

    /**
     * Remove item from cart.
     */
    public function remove($id)
    {
        // Get current cart
        $cart = Session::get('cart', []);

        // Remove product from cart
        if (isset($cart[$id])) {
            unset($cart[$id]);
            Session::put('cart', $cart);
        }

        return redirect()->route('cart.index')
            ->with('success', 'Item removed from cart!');
    }

    /**
     * Clear cart.
     */
    public function clear()
    {
        // Remove cart from session
        Session::forget('cart');

        return redirect()->route('cart.index')
            ->with('success', 'Cart cleared successfully!');
    }
}
