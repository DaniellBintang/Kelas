<?php
// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Display the homepage with featured products and banners.
     */
    public function index(Request $request)
    {
        // Get products (limit 9)
        $products = Product::take(9)->get();

        // Get banners
        $staticBanners = Banner::where('type', 'static')->orderBy('id')->get();
        $dynamicBanners = Banner::where('type', 'dynamic')->orderBy('id')->get();

        // Check if product was added to cart
        $addedToCart = false;

        // Get cart total quantity
        $cartTotalQuantity = $this->getCartTotalQuantity();

        return view('home', compact(
            'products',
            'staticBanners',
            'dynamicBanners',
            'addedToCart',
            'cartTotalQuantity'
        ));
    }

    /**
     * Add a product to cart.
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

        // Return to the referring page with the addedToCart flag
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
