<!-- resources/views/admin/menus/index.blade.php -->
@extends('layouts.admin')

@section('title', 'Daftar Menu')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Daftar Menu</li>
@endsection

@section('page-title', 'Manajemen Menu')

@section('page-actions')
    <div>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Tambah Menu Baru
        </a>
    </div>
@endsection

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

        /* Menu cards */
        .card:hover {
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

        /* Responsive adjustments */
        @media (max-width: 767.98px) {
            .filter-buttons {
                margin-top: 15px;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Search & Filter Section -->
    <div class="card mb-4 filter-section">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('admin.menus.index') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                placeholder="Cari berdasarkan nama menu, deskripsi, atau harga..." name="search"
                                value="{{ request('search') }}" aria-label="Search menus">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            @if (request('search'))
                                <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary">
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
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item {{ request('filter') == 'price_high' ? 'active' : '' }}"
                                        href="{{ route('admin.menus.index', ['filter' => 'price_high', 'search' => request('search')]) }}">
                                        Harga Tertinggi
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request('filter') == 'price_low' ? 'active' : '' }}"
                                        href="{{ route('admin.menus.index', ['filter' => 'price_low', 'search' => request('search')]) }}">
                                        Harga Terendah
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item {{ request('filter') == 'newest' ? 'active' : '' }}"
                                        href="{{ route('admin.menus.index', ['filter' => 'newest', 'search' => request('search')]) }}">
                                        Terbaru
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            @if (request('search'))
                <div class="mt-3">
                    <div class="alert alert-info d-flex align-items-center mb-0">
                        <i class="fas fa-search me-2"></i>
                        <div>
                            Hasil pencarian untuk: "{{ request('search') }}"
                            <span class="badge bg-secondary ms-2">{{ $menus->total() }} hasil</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Menu Cards Grid View (Default) -->
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
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4">
                        @forelse($menus as $menu)
                            <div class="col">
                                <div class="card h-100">
                                    <div class="position-relative">
                                        <img src="{{ asset($menu->image) }}" class="card-img-top"
                                            alt="{{ $menu->name }}" style="height: 200px; object-fit: cover;">
                                        <div class="position-absolute top-0 end-0 p-2">
                                            <span class="badge bg-primary rounded-pill">Rp
                                                {{ number_format($menu->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $menu->name }}</h5>
                                        <p class="card-text text-muted small">{{ Str::limit($menu->description, 100) }}</p>
                                    </div>
                                    <div class="card-footer bg-white border-top-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="btn-group">
                                                <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit me-1"></i>Edit
                                                </a>
                                                <button type="button" class="btn btn-sm btn-outline-danger delete-menu-btn"
                                                    data-bs-toggle="modal" data-bs-target="#deleteMenuModal"
                                                    data-menu-id="{{ $menu->id }}"
                                                    data-menu-name="{{ $menu->name }}">
                                                    <i class="fas fa-trash me-1"></i>Hapus
                                                </button>
                                            </div>
                                            <small class="text-muted">ID: #{{ $menu->id }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert {{ request('search') ? 'alert-warning' : 'alert-info' }} mb-0">
                                    @if (request('search'))
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        Tidak ada menu yang sesuai dengan pencarian "{{ request('search') }}"
                                    @else
                                        <i class="fas fa-info-circle me-2"></i>
                                        Belum ada menu yang ditambahkan.
                                    @endif
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Table View -->
                <div class="tab-pane fade" id="table-view">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle data-table">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Gambar</th>
                                    <th>Nama</th>
                                    <th>Deskripsi</th>
                                    <th>Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($menus as $menu)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <img src="{{ asset($menu->image) }}" alt="{{ $menu->name }}"
                                                class="rounded" width="60" height="60"
                                                style="object-fit: cover;">
                                        </td>
                                        <td>{{ $menu->name }}</td>
                                        <td>{{ Str::limit($menu->description, 50) }}</td>
                                        <td>Rp {{ number_format($menu->price, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button"
                                                    class="btn btn-sm btn-outline-danger delete-menu-btn"
                                                    data-bs-toggle="modal" data-bs-target="#deleteMenuModal"
                                                    data-menu-id="{{ $menu->id }}"
                                                    data-menu-name="{{ $menu->name }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-4">Belum ada menu yang ditambahkan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Global Delete Modal -->
    <div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="deleteMenuModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteMenuModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus menu "<span id="menuNameToDelete"></span>"?</p>
                    <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteMenuForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure dropdowns work properly
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

            dropdownToggles.forEach(toggle => {
                toggle.addEventListener('click', function(e) {
                    // Prevent any parent elements from catching this event
                    e.stopPropagation();
                });
            });

            // Handle delete modal
            const deleteModal = document.getElementById('deleteMenuModal');
            const deleteButtons = document.querySelectorAll('.delete-menu-btn');
            const menuNameElement = document.getElementById('menuNameToDelete');
            const deleteForm = document.getElementById('deleteMenuForm');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const menuId = this.getAttribute('data-menu-id');
                    const menuName = this.getAttribute('data-menu-name');

                    menuNameElement.textContent = menuName;
                    deleteForm.action = '/admin/menus/' + menuId; // Sesuaikan dengan route Anda
                });
            });

            // Save the active tab preference
            const tabs = document.querySelectorAll('[data-bs-toggle="tab"]');

            tabs.forEach(tab => {
                tab.addEventListener('shown.bs.tab', function(e) {
                    localStorage.setItem('menuActiveTab', e.target.getAttribute('href'));
                });
            });

            // Restore the active tab
            const activeTab = localStorage.getItem('menuActiveTab');
            if (activeTab) {
                const tab = document.querySelector(`[href="${activeTab}"]`);
                if (tab) {
                    const bsTab = new bootstrap.Tab(tab);
                    bsTab.show();
                }
            });
        });
    </script>
@endsection
