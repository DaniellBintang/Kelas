<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderHistoryController extends Controller
{
    /**
     * Display customer's order history
     */
    public function index()
    {
        $user = Auth::user();

        // Get all orders for the authenticated user with their items and products
        $orders = Order::with(['items.product', 'ratings'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Add rated status to each order
        $orders->each(function ($order) use ($user) {
            $order->has_been_rated = $order->ratings->where('user_id', $user->id)->count() > 0;
        });

        // Get cart quantity for the badge
        $cartTotalQuantity = $this->getCartTotalQuantity();

        return view('order-history', compact('orders', 'cartTotalQuantity'));
    }

    /**
     * Submit a review for an order
     */
    public function submitReview(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|integer|exists:orders,id',
            'product_id' => 'required|integer|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        $user = Auth::user();

        // Check if the order belongs to the user
        $order = Order::where('id', $validated['order_id'])
            ->where('user_id', $user->id)
            ->where('status', 'Completed')
            ->first();

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found or not completed']);
        }

        // Check if user has already rated this order
        $existingRating = Rating::where('order_id', $validated['order_id'])
            ->where('user_id', $user->id)
            ->first();

        if ($existingRating) {
            return response()->json(['success' => false, 'message' => 'You have already rated this order']);
        }

        // Create the rating
        Rating::create([
            'user_id' => $user->id,
            'product_id' => $validated['product_id'],
            'order_id' => $validated['order_id'],
            'rating' => $validated['rating'],
            'review' => $validated['review'],
        ]);

        return response()->json(['success' => true, 'message' => 'Review submitted successfully']);
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
