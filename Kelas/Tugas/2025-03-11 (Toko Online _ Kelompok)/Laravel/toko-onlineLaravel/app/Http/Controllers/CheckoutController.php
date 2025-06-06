<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    /**
     * Display the checkout page
     */
    public function index()
    {
        $user = Auth::user();
        $cart = Session::get('cart', []);

        // Redirect if cart is empty
        if (empty($cart)) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty. Please add some products first.');
        }

        // Get user's additional addresses
        $additionalAddresses = CustomerAddress::where('user_id', $user->id)->get();

        // Get cart items with product details
        $cartItems = [];
        $totalPrice = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $subtotal = $product->price * $quantity;
                $totalPrice += $subtotal;
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal
                ];
            }
        }

        // Get cart quantity for badge
        $cartTotalQuantity = array_sum($cart);

        return view('checkout', compact('user', 'additionalAddresses', 'cartItems', 'totalPrice', 'cartTotalQuantity'));
    }

    /**
     * Process the checkout
     */
    public function process(Request $request)
    {
        Log::info('Checkout process started', ['request_data' => $request->all()]);

        $user = Auth::user();
        $cart = Session::get('cart', []);

        // Validate cart is not empty
        if (empty($cart)) {
            Log::warning('Checkout attempted with empty cart', ['user_id' => $user->id]);
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        // Validate request
        $validationRules = [
            'address_id' => 'nullable|string',
            'use_new_address' => 'nullable|boolean',
        ];

        // Add conditional validation for new address
        if ($request->has('use_new_address') && $request->use_new_address) {
            $validationRules['new_address'] = 'required|string|max:255';
            $validationRules['new_city'] = 'required|string|max:100';
            $validationRules['new_postal_code'] = 'required|string|max:20';
            $validationRules['save_address'] = 'nullable|boolean';
        }

        try {
            $validated = $request->validate($validationRules);
            Log::info('Validation passed', ['validated_data' => $validated]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation failed', ['errors' => $e->errors()]);
            return back()->withErrors($e->errors())->withInput();
        }

        try {
            DB::beginTransaction();

            // Determine shipping address
            if ($request->has('use_new_address') && $request->use_new_address) {
                Log::info('Using new address');
                // Use new address
                $shippingAddress = $validated['new_address'];
                $shippingCity = $validated['new_city'];
                $shippingPostalCode = $validated['new_postal_code'];

                // Save address if requested
                if ($request->has('save_address') && $request->save_address) {
                    CustomerAddress::create([
                        'user_id' => $user->id,
                        'address' => $shippingAddress,
                        'city' => $shippingCity,
                        'postal_code' => $shippingPostalCode,
                    ]);
                    Log::info('New address saved for future use');
                }
            } else {
                Log::info('Using existing address');
                // Use existing address
                $addressId = $request->input('address_id', 'default');

                if ($addressId === 'default') {
                    // Use user's default address
                    $shippingAddress = $user->address;
                    $shippingCity = $user->city;
                    $shippingPostalCode = $user->postal_code;
                    Log::info('Using user default address');
                } else {
                    // Use selected additional address
                    $address = CustomerAddress::where('id', $addressId)
                        ->where('user_id', $user->id)
                        ->first();

                    if (!$address) {
                        throw new \Exception('Selected address not found');
                    }

                    $shippingAddress = $address->address;
                    $shippingCity = $address->city;
                    $shippingPostalCode = $address->postal_code;
                    Log::info('Using additional address', ['address_id' => $addressId]);
                }
            }

            // Calculate total and prepare order items
            $totalPrice = 0;
            $orderItems = [];

            foreach ($cart as $productId => $quantity) {
                $product = Product::find($productId);
                if ($product) {
                    $subtotal = $product->price * $quantity;
                    $totalPrice += $subtotal;
                    $orderItems[] = [
                        'product_id' => $product->id,
                        'quantity' => $quantity,
                        'price' => $product->price
                    ];
                }
            }

            Log::info('Order calculation completed', [
                'total_price' => $totalPrice,
                'items_count' => count($orderItems)
            ]);

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'total_price' => $totalPrice,
                'status' => 'Pending',
                'shipping_address' => $shippingAddress,
                'shipping_city' => $shippingCity,
                'shipping_postal_code' => $shippingPostalCode,
            ]);

            Log::info('Order created', ['order_id' => $order->id]);

            // Create order items
            foreach ($orderItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            Log::info('Order items created', ['order_id' => $order->id]);

            // Clear cart
            Session::forget('cart');
            Log::info('Cart cleared');

            DB::commit();
            Log::info('Transaction committed successfully');

            return redirect()->route('checkout.success', $order->id)
                ->with('success', 'Your order has been placed successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Checkout process failed', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'An error occurred while processing your order: ' . $e->getMessage());
        }
    }

    /**
     * Show order success page
     */
    public function success($orderId)
    {
        try {
            $order = Order::with(['items.product', 'user'])
                ->where('id', $orderId)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // Get cart quantity for badge (should be 0 after checkout)
            $cartTotalQuantity = 0;

            return view('checkout.success', compact('order', 'cartTotalQuantity'));
        } catch (\Exception $e) {
            Log::error('Failed to load success page', [
                'order_id' => $orderId,
                'user_id' => Auth::id(),
                'error' => $e->getMessage()
            ]);

            return redirect()->route('cart.index')
                ->with('error', 'Order not found or you do not have permission to view it.');
        }
    }
}
