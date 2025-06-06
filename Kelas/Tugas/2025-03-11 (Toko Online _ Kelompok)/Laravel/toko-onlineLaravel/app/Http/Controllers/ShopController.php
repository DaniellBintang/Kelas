<?php
// app/Http/Controllers/ShopController.php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    /**
     * Display the shop page with all products.
     */
    public function index(Request $request)
    {
        // Get sorting parameter
        $sort = $request->input('sort', 'name_asc');

        // Build the query with proper sorting
        $query = Product::query();

        switch ($sort) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;

            case 'name_desc':
                $query->orderBy('name', 'desc');
                break;

            default: // name_asc
                $query->orderBy('name', 'asc');
                break;
        }

        // Execute the query
        $products = $query->get();

        // Check if a product was added to cart
        $addedToCart = session('addedToCart', false);

        // Get cart quantity for the badge
        $cartTotalQuantity = $this->getCartTotalQuantity();

        return view('shop', compact('products', 'sort', 'addedToCart', 'cartTotalQuantity'));
    }

    /**
     * Add a product to the cart.
     */
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = 1; // Default quantity

        // Get the current cart from session or create a new one
        $cart = Session::get('cart', []);

        // Add the product to cart or increment quantity if already in cart
        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        // Save cart back to session
        Session::put('cart', $cart);

        // Redirect back with a flag to show the modal
        return redirect()->back()->with('addedToCart', true);
    }

    /**
     * Get total quantity of items in cart.
     */
    private function getCartTotalQuantity()
    {
        $cart = Session::get('cart', []);
        return array_sum($cart);
    }
}
