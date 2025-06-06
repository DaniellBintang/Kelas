<?php
// app/Http/Controllers/AboutController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutController extends Controller
{
    /**
     * Display the about page.
     */
    public function index()
    {
        // Get cart quantity for the badge
        $cartTotalQuantity = $this->getCartTotalQuantity();

        return view('about', compact('cartTotalQuantity'));
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
