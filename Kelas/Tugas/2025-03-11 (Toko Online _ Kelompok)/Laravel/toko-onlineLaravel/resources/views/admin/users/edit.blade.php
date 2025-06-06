{{-- resources/views/admin/users/edit.blade.php --}}

@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
    <div class="dashboard-header">
        <div class="dashboard-icon">
            <i class="fas fa-user-edit"></i>
        </div>
        <h1>Edit User</h1>
        <p>Update user account information</p>
    </div>

    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to Users
        </a>
    </div>

    <div class="content-container">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">User Information</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="full_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control @error('full_name') is-invalid @enderror" id="full_name"
                            name="full_name" value="{{ old('full_name', $user->full_name) }}" required>
                        @error('full_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                            name="password">
                        <div class="form-text">Leave blank if you don't want to change the password</div>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Update User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
