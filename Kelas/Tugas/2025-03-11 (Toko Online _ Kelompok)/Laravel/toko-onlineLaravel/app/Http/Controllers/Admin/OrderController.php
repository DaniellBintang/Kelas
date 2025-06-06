<?php
// app/Http/Controllers/Admin/OrderController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index()
    {
        // Get all orders with user information
        $orders = Order::with('user', 'items.product')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Get order details for a specific order
     */
    public function getOrderDetails($id)
    {
        $orderItems = OrderItem::with('product')
            ->where('order_id', $id)
            ->get();

        return response()->json($orderItems);
    }

    /**
     * Update order status.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Processing,Completed,Cancelled',
        ]);

        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order status updated successfully!');
    }

    /**
     * Remove the order.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order deleted successfully!');
    }
}
