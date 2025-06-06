@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="dashboard-header">
        <div class="dashboard-icon">
            <i class="fas fa-tachometer-alt"></i>
        </div>
        <h1>Admin Dashboard</h1>
        <p>Selamat datang di panel admin Fender Guitar Shop</p>
    </div>

    <div class="admin-info">
        <i class="fas fa-user-circle"></i>
        <p>Status: <strong>Admin Panel</strong></p>
    </div>

    <div class="menu-grid">
        <a href="{{ route('admin.products.index') }}" class="menu-item">
            <div class="menu-item-header">
                <i class="fas fa-guitar"></i>
            </div>
            <div class="menu-item-body">
                <div class="menu-item-icon">
                    <i class="fas fa-box"></i>
                </div>
                <h3 class="menu-item-title">Manage Products</h3>
                <p class="menu-item-desc">Add, edit, or delete products from your inventory</p>
                @if (isset($stats['products']))
                    <span class="badge bg-primary">{{ $stats['products'] }} products</span>
                @endif
            </div>
        </a>

        <a href="{{ route('admin.banners.index') }}" class="menu-item">
            <div class="menu-item-header">
                <i class="fas fa-images"></i>
            </div>
            <div class="menu-item-body">
                <div class="menu-item-icon">
                    <i class="fas fa-image"></i>
                </div>
                <h3 class="menu-item-title">Manage Banners</h3>
                <p class="menu-item-desc">Update banners and promotional images</p>
            </div>
        </a>

        <a href="{{ route('admin.orders.index') }}" class="menu-item">
            <div class="menu-item-header">
                <i class="fas fa-shopping-cart"></i>
            </div>
            <div class="menu-item-body">
                <div class="menu-item-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3 class="menu-item-title">Manage Orders</h3>
                <p class="menu-item-desc">View and process customer orders</p>
                @if (isset($stats['orders']))
                    <span class="badge bg-primary">{{ $stats['orders'] }} orders</span>
                @endif
            </div>
        </a>

        <a href="{{ route('admin.ratings.index') }}" class="menu-item">
            <div class="menu-item-header">
                <i class="fas fa-star"></i>
            </div>
            <div class="menu-item-body">
                <div class="menu-item-icon">
                    <i class="fas fa-star-half-alt"></i>
                </div>
                <h3 class="menu-item-title">Manage Ratings</h3>
                <p class="menu-item-desc">View and manage product reviews and ratings</p>
                @if (isset($stats['ratings']))
                    <span class="badge bg-primary">{{ $stats['ratings'] }} reviews</span>
                @endif
            </div>
        </a>

        <a href="{{ route('admin.contacts.index') }}" class="menu-item">
            <div class="menu-item-header">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="menu-item-body">
                <div class="menu-item-icon">
                    <i class="fas fa-address-book"></i>
                </div>
                <h3 class="menu-item-title">Manage Contacts</h3>
                <p class="menu-item-desc">View and respond to customer inquiries</p>
                @if (isset($stats['contacts']))
                    <span class="badge bg-primary">{{ $stats['contacts'] }} messages</span>
                @endif
            </div>
        </a>

        <a href="{{ route('admin.users.index') }}" class="menu-item">
            <div class="menu-item-header">
                <i class="fas fa-users"></i>
            </div>
            <div class="menu-item-body">
                <div class="menu-item-icon">
                    <i class="fas fa-user-cog"></i>
                </div>
                <h3 class="menu-item-title">Manage Users</h3>
                <p class="menu-item-desc">Manage user accounts and permissions</p>
                @if (isset($stats['users']))
                    <span class="badge bg-primary">{{ $stats['users'] }} users</span>
                @endif
            </div>
        </a>
    </div>

    <form action="{{ route('admin.logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="logout-btn">
            <i class="fas fa-sign-out-alt me-2"></i> Logout
        </button>
    </form>
@endsection
