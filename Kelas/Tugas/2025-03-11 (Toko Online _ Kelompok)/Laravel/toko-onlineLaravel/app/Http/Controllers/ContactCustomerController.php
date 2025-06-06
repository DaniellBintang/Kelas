<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ContactCustomerController extends Controller
{
    /**
     * Display the contact form
     */
    public function index()
    {
        $user = Auth::user();

        // Get cart quantity for badge
        $cartTotalQuantity = $this->getCartTotalQuantity();

        return view('contact', compact('user', 'cartTotalQuantity'));
    }

    /**
     * Store the contact message
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        // Create the contact message
        ContactMessage::create([
            'user_id' => $user->id, // Associate with the logged-in user
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'is_read' => false,
        ]);

        return redirect()->route('contact')
            ->with('success', 'Thank you for your message! We will get back to you soon.');
    }

    /**
     * Get total quantity of items in cart
     */
    private function getCartTotalQuantity()
    {
        $cart = Session::get('cart', []);
        return array_sum($cart);
    }
}
