{{-- resources/views/admin/users/show.blade.php --}}

@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
    <div class="dashboard-header">
        <div class="dashboard-icon">
            <i class="fas fa-user"></i>
        </div>
        <h1>User Details</h1>
        <p>View detailed information about this user</p>
    </div>

    <div class="mb-4">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to Users
        </a>
    </div>

    <div class="content-container">
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">User Information</h5>
                <div>
                    <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1"></i> Edit
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">User ID</div>
                    <div class="col-md-8">{{ $user->id }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Full Name</div>
                    <div class="col-md-8">{{ $user->full_name }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Email Address</div>
                    <div class="col-md-8">{{ $user->email }}</div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Registration Date</div>
                    <div class="col-md-8">
                        @if ($user->created_at)
                            {{ $user->created_at->format('F j, Y \a\t g:i A') }}
                        @else
                            Not available
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4 fw-bold">Last Updated</div>
                    <div class="col-md-8">
                        @if ($user->updated_at)
                            {{ $user->updated_at->format('F j, Y \a\t g:i A') }}
                        @else
                            Not available
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Orders</h5>
                    </div>
                    <div class="card-body">
                        @if ($user->orders && $user->orders->count() > 0)
                            <div class="list-group">
                                @foreach ($user->orders as $order)
                                    <a href="{{ route('admin.orders.show', $order->id) }}"
                                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        Order #{{ $order->id }}
                                        <span class="badge bg-primary rounded-pill">
                                            @if ($order->created_at)
                                                {{ $order->created_at->format('M j, Y') }}
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info mb-0">
                                <i class="fas fa-info-circle me-2"></i> No orders found for this user.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-white">
                        <h5 class="mb-0">Ratings & Reviews</h5>
                    </div>
                    <div class="card-body">
                        @if ($user->ratings && $user->ratings->count() > 0)
                            <div class="list-group">
                                @foreach ($user->ratings as $rating)
                                    <a href="{{ route('admin.ratings.show', $rating->id) }}"
                                        class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                        <div>
                                            {{ $rating->product->name ?? 'Unknown Product' }}
                                            <div class="text-muted small">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $rating->rating)
                                                        <i class="fas fa-star text-warning"></i>
                                                    @else
                                                        <i class="far fa-star text-warning"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                        </div>
                                        <span class="badge bg-secondary rounded-pill">
                                            @if ($rating->created_at)
                                                {{ $rating->created_at->format('M j, Y') }}
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info mb-0">
                                <i class="fas fa-info-circle me-2"></i> No ratings or reviews found for this user.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the user <strong>{{ $user->full_name }}</strong>?</p>
                    <p>This will delete all the user's data including orders and reviews.</p>
                    <p class="text-danger">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete User</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
