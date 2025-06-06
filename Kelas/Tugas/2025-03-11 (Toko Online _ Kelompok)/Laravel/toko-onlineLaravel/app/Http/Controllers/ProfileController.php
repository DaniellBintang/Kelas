<?php
// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit()
    {
        // Get the authenticated user
        $user = User::find(Auth::id());

        // Get cart quantity for the badge
        $cartTotalQuantity = $this->getCartTotalQuantity();

        return view('profile.edit', compact('user', 'cartTotalQuantity'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        // Get the authenticated user
        $user = User::find(Auth::id());

        // Validate the form data
        $validated = $request->validate([
            'full_name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id)
            ],
            'address' => ['required', 'string'],
            'city' => ['required', 'string', 'max:100'],
            'postal_code' => ['required', 'string', 'max:20'],
            'phone' => ['required', 'string', 'max:20'],
        ]);

        // Update the user information
        $user->full_name = $validated['full_name'];
        $user->email = $validated['email'];
        $user->address = $validated['address'];
        $user->city = $validated['city'];
        $user->postal_code = $validated['postal_code'];
        $user->phone = $validated['phone'];

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Save the changes
        $user->save();

        // Set success message
        return redirect()->route('profile.edit')
            ->with('success', 'Profile updated successfully!');
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
