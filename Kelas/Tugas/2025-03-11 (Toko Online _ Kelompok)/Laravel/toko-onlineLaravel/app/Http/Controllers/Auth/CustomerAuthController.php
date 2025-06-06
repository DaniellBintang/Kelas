<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class CustomerAuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Handle customer login
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the customer
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            // Redirect to intended page or cart
            return redirect()->intended(route('cart.index'))
                ->with('success', 'Welcome back!');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput($request->except('password'));
    }

    /**
     * Show the registration form
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Handle customer registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
        ]);

        // Create new user
        $user = User::create([
            'full_name' => $validated['full_name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'address' => $validated['address'],
            'city' => $validated['city'],
            'postal_code' => $validated['postal_code'],
            'phone' => $validated['phone'],
        ]);

        // Login the user
        Auth::login($user);

        return redirect()->route('cart.index')
            ->with('success', 'Account created successfully! Welcome to our store.');
    }

    /**
     * Handle customer logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'You have been logged out successfully');
    }
}
