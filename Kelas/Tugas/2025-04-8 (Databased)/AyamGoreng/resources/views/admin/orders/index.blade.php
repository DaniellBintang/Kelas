@extends('layouts.admin')

@section('title', 'Daftar Order')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Daftar Order</li>
@endsection

@section('page-title', 'Manajemen Order')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
    </a>
    <a href="{{ route('admin.users.index') ?? '#' }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <i class="fas fa-users me-2"></i>Users
    </a>
    <a href="{{ route('admin.menus.index') ?? '#' }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
        <i class="fas fa-utensils me-2"></i>Menu
    </a>
    <a href="{{ route('admin.orders.index') ?? '#' }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
        <i class="fas fa-shopping-cart me-2"></i>Orders
    </a>
@endsection

@section('css')
    <style>
        /* Card styling */
        .card {
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            border: none;
            transition: all 0.3s ease;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f1f1f1;
        }

        /* Order cards */
        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        /* Fix for dropdown menus */
        .dropdown-menu {
            z-index: 1030;
            /* Higher z-index to ensure it appears above other elements */
        }

        /* Position the dropdown menu correctly */
        .dropdown {
            position: relative;
        }

        /* Add margin below filter section */
        .filter-section {
            margin-bottom: 25px;
            /* Add more space below the filter section */
        }

        /* Custom table styling */
        .table> :not(caption)>*>* {
            padding: 0.75rem 1rem;
        }

        .table-view-container {
            overflow-x: auto;
        }

        /* Tab styling */
        .nav-tabs .nav-link {
            color: #495057;
            border-radius: 0;
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            color: #4a6fdc;
            border-color: #dee2e6 #dee2e6 #fff;
            border-bottom: 2px solid #4a6fdc;
        }

        /* Badge styling */
        .status-badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
        }

        /* Select styling */
        .status-select {
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 0.375rem 2rem 0.375rem 0.75rem;
        }

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .filter-buttons {
                margin-top: 15px;
            }
        }

        /* Empty state styling */
        .empty-state {
            padding: 3rem 0;
            text-align: center;
        }

        .empty-state-icon {
            font-size: 3rem;
            color: #d9d9d9;
            margin-bottom: 1rem;
        }
    </style>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Search & Filter Section -->
    <div class="card mb-4 filter-section">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('admin.orders.index') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                placeholder="Cari berdasarkan No. Order, Nama Pelanggan, atau Tanggal (YYYY-MM-DD)"
                                name="search" value="{{ request('search') }}" aria-label="Search orders"
                                aria-describedby="search-addon">
                            <button class="btn btn-outline-primary" type="submit" id="search-addon">
                                <i class="fas fa-search"></i>
                            </button>
                            @if (request('search'))
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end filter-buttons">
                        <div class="dropdown me-2">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-filter me-1"></i>Filter Status
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.orders.index', ['status' => 'all']) }}">Semua Status</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.orders.index', ['status' => 'pending']) }}">Pending</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.orders.index', ['status' => 'processing']) }}">Processing</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.orders.index', ['status' => 'shipped']) }}">Shipped</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.orders.index', ['status' => 'delivered']) }}">Delivered</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.orders.index', ['status' => 'canceled']) }}">Canceled</a>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-sort me-1"></i>Sort
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.orders.index', ['sort' => 'newest']) }}">Terbaru</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.orders.index', ['sort' => 'oldest']) }}">Terlama</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.orders.index', ['sort' => 'highest']) }}">Total Tertinggi</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.orders.index', ['sort' => 'lowest']) }}">Total Terendah</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Orders View -->
    <div class="card">
        <div class="card-header p-3">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#grid-view">
                        <i class="fas fa-th me-1"></i>Grid View
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#table-view">
                        <i class="fas fa-list me-1"></i>Table View
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <!-- Grid View -->
                <div class="tab-pane fade show active" id="grid-view">
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        @forelse($orders as $order)
                            <div class="col">
                                <div class="card h-100 order-card">
                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0">Order #{{ $order->id }}</h6>
                                        <span
                                            class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'delivered' ? 'success' : ($order->status == 'canceled' ? 'danger' : 'primary')) }} status-badge">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <small class="text-muted">Nama Pelanggan</small>
                                            <h6>{{ $order->user->name ?? 'Guest' }}</h6>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Total Harga</small>
                                            <h5 class="text-primary">Rp
                                                {{ number_format($order->total_price, 0, ',', '.') }}</h5>
                                        </div>
                                        <div class="mb-3">
                                            <small class="text-muted">Tanggal Order</small>
                                            <div><i
                                                    class="far fa-calendar-alt me-1"></i>{{ $order->created_at->format('d M Y, H:i') }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white border-top-0">
                                        <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="d-flex align-items-center">
                                                <label class="me-2 small text-muted">Status:</label>
                                                <select name="status" class="form-select form-select-sm status-select"
                                                    onchange="this.form.submit()">
                                                    <option value="pending"
                                                        {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="processing"
                                                        {{ $order->status == 'processing' ? 'selected' : '' }}>
                                                        Processing</option>
                                                    <option value="shipped"
                                                        {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                                        Shipped</option>
                                                    <option value="delivered"
                                                        {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                                        Delivered</option>
                                                    <option value="canceled"
                                                        {{ $order->status == 'canceled' ? 'selected' : '' }}>
                                                        Canceled</option>
                                                </select>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-shopping-cart"></i>
                                    </div>
                                    <h5>Belum Ada Order</h5>
                                    <p class="text-muted">Saat ini belum ada order yang masuk.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Table View -->
                <div class="tab-pane fade" id="table-view">
                    <div class="table-view-container">
                        <table class="table table-hover align-middle data-table">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->user->name ?? 'Guest' }}</td>
                                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'delivered' ? 'success' : ($order->status == 'canceled' ? 'danger' : 'primary')) }} status-badge">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td><i
                                                class="far fa-calendar-alt me-1"></i>{{ $order->created_at->format('d M Y, H:i') }}
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.orders.updateStatus', $order) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status"
                                                    class="form-select form-select-sm d-inline status-select"
                                                    style="width: auto" onchange="this.form.submit()">
                                                    <option value="pending"
                                                        {{ $order->status == 'pending' ? 'selected' : '' }}>
                                                        Pending</option>
                                                    <option value="processing"
                                                        {{ $order->status == 'processing' ? 'selected' : '' }}>
                                                        Processing</option>
                                                    <option value="shipped"
                                                        {{ $order->status == 'shipped' ? 'selected' : '' }}>
                                                        Shipped</option>
                                                    <option value="delivered"
                                                        {{ $order->status == 'delivered' ? 'selected' : '' }}>
                                                        Delivered</option>
                                                    <option value="canceled"
                                                        {{ $order->status == 'canceled' ? 'selected' : '' }}>
                                                        Canceled</option>
                                                </select>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">Belum ada order yang masuk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if ($orders->count() > 0)
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        Menampilkan {{ $orders->firstItem() ?? 0 }} sampai {{ $orders->lastItem() ?? 0 }} dari
                        {{ $orders->total() }} order
                    </div>
                    <div>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        // No need for the manual animation script since we're using CSS transitions
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure dropdowns work properly
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    // Prevent any parent elements from catching this event
                    e.stopPropagation();
                });
            });

            // Save the active tab preference
            const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');

            tabs.forEach(tab => {
                tab.addEventListener('shown.bs.tab', function(e) {
                    localStorage.setItem('orderActiveTab', e.target.getAttribute('href'));
                });
            });

            // Restore the active tab
            const activeTab = localStorage.getItem('orderActiveTab');
            if (activeTab) {
                const tab = document.querySelector(`[href="${activeTab}"]`);
                if (tab) {
                    const bsTab = new bootstrap.Tab(tab);
                    bsTab.show();
                }
            }
        });
    </script>
@endsection
