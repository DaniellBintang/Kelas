{{-- resources/views/admin/ratings/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Manage Ratings')

@section('styles')
    <style>
        /* Rating color classes */
        .rating-1 {
            background-color: #dc3545 !important;
        }

        .rating-2 {
            background-color: #fd7e14 !important;
        }

        .rating-3 {
            background-color: #ffc107 !important;
            color: #212529 !important;
        }

        .rating-4 {
            background-color: #198754 !important;
        }

        .rating-5 {
            background-color: #0d6efd !important;
        }

        .badge.bg-rating {
            font-size: 0.85rem;
            padding: 0.35rem 0.65rem;
        }

        .rating-stars {
            color: #FFD700;
        }

        .comment-text {
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .filter-section {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
        }

        @media (max-width: 991px) {
            .filter-btn {
                width: 100%;
                margin-top: 1rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-header">
        <div class="dashboard-icon">
            <i class="fas fa-star"></i>
        </div>
        <h1>Manage Ratings</h1>
        <p>View and manage product ratings and reviews</p>
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

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="filter-section">
        <form method="get" action="{{ route('admin.ratings.index') }}" class="row g-3 align-items-end">
            <div class="col-md-5">
                <label for="product" class="form-label">Filter by Product</label>
                <input type="text" class="form-control" id="product" name="product" placeholder="Enter product name"
                    value="{{ $productFilter }}">
            </div>
            <div class="col-md-4">
                <label for="rating" class="form-label">Filter by Rating</label>
                <select class="form-select" id="rating" name="rating">
                    <option value="">All Ratings</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ $ratingFilter == $i ? 'selected' : '' }}>
                            {{ $i }} Star{{ $i > 1 ? 's' : '' }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary filter-btn">
                    <i class="fas fa-filter me-2"></i> Apply Filters
                </button>
                @if (!empty($productFilter) || !empty($ratingFilter))
                    <a href="{{ route('admin.ratings.index') }}" class="btn btn-outline-secondary filter-btn mt-2">
                        <i class="fas fa-times me-2"></i> Clear Filters
                    </a>
                @endif
            </div>
        </form>
    </div>

    <div class="content-container">
        @if (count($ratings) > 0)
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Product</th>
                            <th scope="col">User</th>
                            <th scope="col">Rating</th>
                            <th scope="col">Comment</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ratings as $rating)
                            <tr>
                                <td>{{ $rating->id }}</td>
                                <td>{{ $rating->product->name }}</td>
                                <td>{{ $rating->user->full_name ?? 'Anonymous' }}</td>
                                <td>
                                    <span class="badge bg-rating rating-{{ $rating->rating }}">
                                        {{ $rating->rating }} <i class="fas fa-star"></i>
                                    </span>
                                </td>
                                <td class="comment-text" title="{{ $rating->review }}">
                                    {{ $rating->review ?: 'No comment' }}
                                </td>
                                <td>{{ $rating->created_at->format('M j, Y') }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#viewModal{{ $rating->id }}">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal{{ $rating->id }}">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- View Modal -->
                            <div class="modal fade" id="viewModal{{ $rating->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Rating Details</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <h6>Product:</h6>
                                                <p>{{ $rating->product->name }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <h6>User:</h6>
                                                <p>{{ $rating->user->full_name ?? 'Anonymous' }}</p>
                                            </div>
                                            <div class="mb-3">
                                                <h6>Rating:</h6>
                                                <p class="rating-stars">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <i class="{{ $i <= $rating->rating ? 'fas' : 'far' }} fa-star"></i>
                                                    @endfor
                                                    <span class="ms-2">({{ $rating->rating }}/5)</span>
                                                </p>
                                            </div>
                                            <div class="mb-3">
                                                <h6>Comment:</h6>
                                                <p>{!! nl2br(e($rating->review ?: 'No comment provided.')) !!}</p>
                                            </div>
                                            <div class="mb-3">
                                                <h6>Date:</h6>
                                                <p>{{ $rating->created_at->format('F j, Y \a\t g:i A') }}</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal{{ $rating->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirm Deletion</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this rating?</p>
                                            <p><strong>Product:</strong> {{ $rating->product->name }}</p>
                                            <p><strong>User:</strong> {{ $rating->user->full_name ?? 'Anonymous' }}</p>
                                            <p><strong>Rating:</strong> {{ $rating->rating }}/5</p>
                                            <p class="text-danger"><strong>This action cannot be undone.</strong></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <form action="{{ route('admin.ratings.destroy', $rating->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                No ratings found.
                @if (!empty($productFilter) || !empty($ratingFilter))
                    <a href="{{ route('admin.ratings.index') }}" class="alert-link">Clear filters</a> to see all ratings.
                @endif
            </div>
        @endif
    </div>
@endsection
