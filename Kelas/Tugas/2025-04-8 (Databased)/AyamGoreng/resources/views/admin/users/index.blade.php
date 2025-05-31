@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Manajemen User</li>
@endsection

@section('page-title', 'Manajemen User')

@section('page-actions')
    <div>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
            <i class="fas fa-user-plus me-2"></i>Tambah User Baru
        </a>
    </div>
@endsection

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
    </a>
    <a href="{{ route('admin.users.index') }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <i class="fas fa-users me-2"></i>Users
    </a>
    <a href="{{ route('admin.menus.index') }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
        <i class="fas fa-utensils me-2"></i>Menu
    </a>
    <a href="{{ route('admin.orders.index') }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
        <i class="fas fa-shopping-cart me-2"></i>Orders
    </a>
@endsection

@section('content')
    <!-- Search & Filter Section -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-8">
                    <form action="{{ route('admin.users.index') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Cari user..." name="search"
                                value="{{ request('search') }}">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-md-4">
                    <div class="d-flex justify-content-end">
                        <div class="dropdown me-2">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-filter me-1"></i>Filter
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.users.index', ['sort' => 'name']) }}">Nama (A-Z)</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.users.index', ['sort' => 'name_desc']) }}">Nama (Z-A)</a>
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.users.index', ['sort' => 'newest']) }}">Terbaru</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.users.index', ['sort' => 'oldest']) }}">Terlama</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.users.index', ['role' => 'admin']) }}">Admin</a></li>
                                <li><a class="dropdown-item"
                                        href="{{ route('admin.users.index', ['role' => 'customer']) }}">Customer</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Flash Messages -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- User Table Card -->
    <div class="card">
        <div class="card-header p-3">
            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#all-users">
                        <i class="fas fa-users me-1"></i>Semua User
                        @if (isset($users))
                            <span class="badge bg-primary rounded-pill">{{ $users->count() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#admin-users">
                        <i class="fas fa-user-shield me-1"></i>Admin
                        @if (isset($admins))
                            <span class="badge bg-danger rounded-pill">{{ $admins->count() }}</span>
                        @endif
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#customer-users">
                        <i class="fas fa-user me-1"></i>Customer
                        @if (isset($users))
                            <span class="badge bg-primary rounded-pill">{{ $users->count() }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <!-- All Users Tab -->
                <!-- All Users Tab -->
                <div class="tab-pane fade show active" id="all-users">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" width="60">#</th>
                                    <th width="80">Avatar</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>Role</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($allUsers ?? [] as $index => $user)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="avatar-wrapper">
                                                @if ($user->avatar)
                                                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}"
                                                        alt="{{ $user->name }}" class="avatar rounded-circle"
                                                        width="40" height="40" style="object-fit: cover;">
                                                @else
                                                    <div class="avatar-placeholder rounded-circle {{ $user->role == 'admin' ? 'bg-danger' : 'bg-primary' }} text-white"
                                                        style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->address ?? '-' }}</td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                        <td>
                                            @if ($user->role == 'admin')
                                                <span class="badge bg-danger">Admin</span>
                                            @else
                                                <span class="badge bg-success">Customer</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="btn btn-sm btn-warning" data-bs-toggle="tooltip"
                                                    title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger delete-user-btn"
                                                    data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                                    data-user-id="{{ $user->id }}"
                                                    data-user-name="{{ $user->name }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-users-slash fa-3x text-muted mb-3"></i>
                                                <h5>Belum ada user yang ditambahkan</h5>
                                                <p class="text-muted">Klik "Tambah User Baru" untuk menambahkan user</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Admin Users Tab -->
                <div class="tab-pane fade" id="admin-users">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" width="60">#</th>
                                    <th width="80">Avatar</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($admins ?? [] as $index => $admin)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="avatar-wrapper">
                                                @if ($admin->avatar)
                                                    <img src="{{ asset('storage/avatars/' . $admin->avatar) }}"
                                                        alt="{{ $admin->name }}" class="avatar rounded-circle"
                                                        width="40" height="40" style="object-fit: cover;">
                                                @else
                                                    <div class="avatar-placeholder rounded-circle bg-danger text-white"
                                                        style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                        {{ strtoupper(substr($admin->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>{{ $admin->address ?? '-' }}</td>
                                        <td>{{ $admin->phone ?? '-' }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.users.edit', $admin->id) }}"
                                                    class="btn btn-sm btn-warning" data-bs-toggle="tooltip"
                                                    title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger delete-user-btn"
                                                    data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                                    data-user-id="{{ $admin->id }}"
                                                    data-user-name="{{ $admin->name }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-user-shield fa-3x text-muted mb-3"></i>
                                                <h5>Belum ada user admin</h5>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Customer Users Tab -->
                <div class="tab-pane fade" id="customer-users">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th class="text-center" width="60">#</th>
                                    <th width="80">Avatar</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th width="150">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users ?? [] as $index => $user)
                                    <tr>
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>
                                            <div class="avatar-wrapper">
                                                @if ($user->avatar)
                                                    <img src="{{ asset('storage/avatars/' . $user->avatar) }}"
                                                        alt="{{ $user->name }}" class="avatar rounded-circle"
                                                        width="40" height="40" style="object-fit: cover;">
                                                @else
                                                    <div class="avatar-placeholder rounded-circle bg-primary text-white"
                                                        style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->address ?? '-' }}</td>
                                        <td>{{ $user->phone ?? '-' }}</td>
                                        <td>
                                            @if ($user->role == 'admin')
                                                <span class="badge bg-danger">Admin</span>
                                            @else
                                                <span class="badge bg-success">Customer</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    class="btn btn-sm btn-warning" data-bs-toggle="tooltip"
                                                    title="Edit User">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger delete-user-btn"
                                                    data-bs-toggle="modal" data-bs-target="#deleteUserModal"
                                                    data-user-id="{{ $user->id }}"
                                                    data-user-name="{{ $user->name }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4">
                                            <div class="d-flex flex-column align-items-center">
                                                <i class="fas fa-users-slash fa-3x text-muted mb-3"></i>
                                                <h5>Belum ada user yang ditambahkan</h5>
                                                <p class="text-muted">Klik "Tambah User Baru" untuk menambahkan user</p>
                                            </div>
                                        </td>
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
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteUserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteUserModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus User
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus user "<span id="userNameToDelete" class="fw-bold"></span>"?</p>
                    <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan dan akan menghapus semua data terkait
                            user ini.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <form id="deleteUserForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-trash me-1"></i>Ya, Hapus User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tooltips
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(
                tooltipTriggerEl));

            // Handle delete modal
            const deleteModal = document.getElementById('deleteUserModal');
            const deleteButtons = document.querySelectorAll('.delete-user-btn');
            const userNameElement = document.getElementById('userNameToDelete');
            const deleteForm = document.getElementById('deleteUserForm');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user-id');
                    const userName = this.getAttribute('data-user-name');

                    userNameElement.textContent = userName;
                    deleteForm.action = `/admin/users/${userId}`;
                });
            });

            // Auto-hide alerts after 5 seconds
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const closeButton = alert.querySelector('.btn-close');
                    if (closeButton) {
                        closeButton.click();
                    }
                }, 5000);
            });

            // Add animation to table rows on hover
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.backgroundColor = '#f8f9fa';
                    this.style.transition = 'background-color 0.3s ease';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.backgroundColor = '';
                });
            });
        });
    </script>
@endsection
