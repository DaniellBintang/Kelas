{{-- resources/views/admin/contacts/show.blade.php --}}

@extends('layouts.admin')

@section('title', 'View Message')

@section('content')
    <div class="dashboard-header">
        <div class="dashboard-icon">
            <i class="fas fa-envelope-open-text"></i>
        </div>
        <h1>Message Details</h1>
        <p>View message from {{ $message->name }}</p>
    </div>

    <div class="mb-4">
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left me-2"></i> Back to All Messages
        </a>
    </div>

    <div class="content-container">
        <div class="card">
            <div class="card-header bg-white">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Message from {{ $message->name }}</h5>
                    <span class="badge {{ $message->is_read ? 'bg-secondary' : 'bg-primary' }}">
                        {{ $message->is_read ? 'Read' : 'Unread' }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2">
                                <strong>From:</strong> {{ $message->name }}
                                <span class="ms-2 text-muted">&lt;{{ $message->email }}&gt;</span>
                            </p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <p class="mb-2">
                                <strong>Received:</strong> {{ $message->created_at->format('F j, Y \a\t g:i A') }}
                            </p>
                        </div>
                    </div>
                    <hr>
                </div>

                <div class="message-content mb-4">
                    {!! nl2br(e($message->message)) !!}
                </div>

                <hr>

                <div class="d-flex justify-content-between align-items-center">
                    <a href="mailto:{{ $message->email }}" class="btn btn-primary">
                        <i class="fas fa-reply me-2"></i> Reply via Email
                    </a>

                    <div>
                        @if (!$message->is_read)
                            <form action="{{ route('admin.contacts.markAsRead', $message->id) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check me-2"></i> Mark as Read
                                </button>
                            </form>
                        @endif

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this message from <strong>{{ $message->name }}</strong>?</p>
                    <p class="text-danger">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="{{ route('admin.contacts.destroy', $message->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
