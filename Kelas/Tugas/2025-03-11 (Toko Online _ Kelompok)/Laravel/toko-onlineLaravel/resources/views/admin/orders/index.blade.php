{{-- resources/views/admin/orders/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Manage Orders')

@section('styles')
    <style>
        .order-details {
            display: none;
            background-color: #f8f9fa;
            padding: 15px;
            margin-top: 10px;
            border-radius: 5px;
        }

        .status-pending {
            background-color: #ffecb5;
            color: #7d5a00;
            border-radius: 4px;
            padding: 5px 10px;
            display: inline-block;
        }

        .status-processing {
            background-color: #b3e5fc;
            color: #01579b;
            border-radius: 4px;
            padding: 5px 10px;
            display: inline-block;
        }

        .status-completed {
            background-color: #c8e6c9;
            color: #1b5e20;
            border-radius: 4px;
            padding: 5px 10px;
            display: inline-block;
        }

        .status-canceled {
            background-color: #ffcdd2;
            color: #b71c1c;
            border-radius: 4px;
            padding: 5px 10px;
            display: inline-block;
        }

        .no-bottom-margin {
            margin-bottom: 0 !important;
            border-bottom: none !important;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-header">
        <div class="dashboard-icon">
            <i class="fas fa-shopping-cart"></i>
        </div>
        <h1>Manage Orders</h1>
        <p>View and manage customer orders</p>
    </div>

    <div class="mb-4">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="content-container">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr class="no-bottom-margin">
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->user->full_name }}</td>
                            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.orders.update-status', $order->id) }}"
                                    style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <option value="Pending"
                                            {{ strtolower($order->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Processing"
                                            {{ strtolower($order->status) == 'processing' ? 'selected' : '' }}>Processing
                                        </option>
                                        <option value="Completed"
                                            {{ strtolower($order->status) == 'completed' ? 'selected' : '' }}>Completed
                                        </option>
                                        <option value="Cancelled"
                                            {{ strtolower($order->status) == 'canceled' ? 'selected' : '' }}>Canceled
                                        </option>
                                    </select>
                                </form>
                            </td>
                            <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                            <td>
                                <button class="btn btn-info btn-sm mb-1" onclick="toggleOrderDetails({{ $order->id }})">
                                    <i class="fas fa-eye me-1"></i> View Details
                                </button>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST"
                                    class="d-inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this order?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash me-1"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" class="p-0">
                                <div id="orderDetails{{ $order->id }}" class="order-details">
                                    <h5 class="mb-3">Order Details</h5>
                                    <table class="table table-sm mb-0">
                                        <thead>
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Unit Price</th>
                                                <th>Quantity</th>
                                                <th>Total Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->items as $item)
                                                <tr>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                    <div class="mt-3">
                                        <h6>Shipping Address:</h6>
                                        <p class="mb-1">{{ $order->shipping_address }}</p>
                                        <p class="mb-0">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No orders found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function toggleOrderDetails(orderId) {
            const detailsDiv = document.getElementById('orderDetails' + orderId);
            if (detailsDiv.style.display === 'none' || detailsDiv.style.display === '') {
                detailsDiv.style.display = 'block';
            } else {
                detailsDiv.style.display = 'none';
            }
        }
    </script>
@endsection
