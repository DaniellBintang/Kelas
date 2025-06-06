{{-- resources/views/admin/users/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
    <div class="dashboard-header">
        <div class="dashboard-icon">
            <i class="fas fa-users"></i>
        </div>
        <h1>Manage Users</h1>
        <p>View and manage user accounts</p>
    </div>

    <div class="mb-4 d-flex justify-content-between">
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
        </a>

        <a href="{{ route('admin.users.create') }}" class="btn btn-success">
            <i class="fas fa-user-plus me-2"></i> Add New User
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="content-container">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">All Users</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Registered On</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->created_at->format('M j, Y') }}</td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('admin.users.show', $user->id) }}"
                                                class="btn btn-sm btn-info">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteUserModal{{ $user->id }}">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Confirm Deletion</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Are you sure you want to delete the user
                                                            <strong>{{ $user->full_name }}</strong>?
                                                        </p>
                                                        <p>This will delete all the user's data including orders and
                                                            reviews.</p>
                                                        <p class="text-danger">This action cannot be undone.</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete
                                                                User</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No users found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
