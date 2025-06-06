{{-- resources/views/admin/contacts/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Manage Contact Messages')

@section('styles')
    <style>
        .message-preview {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .unread {
            font-weight: bold;
            background-color: rgba(13, 110, 253, 0.05);
        }

        .action-buttons {
            white-space: nowrap;
        }

        .message-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 8px;
        }

        .message-indicator.read {
            background-color: #6c757d;
        }

        .message-indicator.unread {
            background-color: #0d6efd;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-header">
        <div class="dashboard-icon">
            <i class="fas fa-envelope"></i>
        </div>
        <h1>Contact Messages</h1>
        <p>Manage customer inquiries and messages</p>
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

    <div class="content-container">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">All Messages</h5>
                <div>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                        data-bs-target="#deleteMultipleModal" id="deleteSelectedBtn" disabled>
                        <i class="fas fa-trash me-2"></i> Delete Selected
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if ($messages->count() > 0)
                    <form id="deleteMultipleForm" action="{{ route('admin.contacts.destroyMultiple') }}" method="POST">
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="selectAll">
                                            </div>
                                        </th>
                                        <th>Status</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                        <tr class="{{ $message->is_read ? '' : 'unread' }}">
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input message-checkbox" type="checkbox"
                                                        name="message_ids[]" value="{{ $message->id }}">
                                                </div>
                                            </td>
                                            <td>
                                                <span class="message-indicator {{ $message->is_read ? 'read' : 'unread' }}"
                                                    title="{{ $message->is_read ? 'Read' : 'Unread' }}"></span>
                                            </td>
                                            <td>{{ $message->name }}</td>
                                            <td>
                                                <a href="mailto:{{ $message->email }}">{{ $message->email }}</a>
                                            </td>
                                            <td class="message-preview">{{ $message->message }}</td>
                                            <td>{{ $message->created_at->format('M j, Y g:i A') }}</td>
                                            <td class="action-buttons">
                                                <a href="{{ route('admin.contacts.show', $message->id) }}"
                                                    class="btn btn-sm btn-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if (!$message->is_read)
                                                    <form action="{{ route('admin.contacts.markAsRead', $message->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success"
                                                            title="Mark as Read">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $message->id }}">
                                                    <i class="fas fa-trash"></i>
                                                </button>

                                                <!-- Delete Modal -->
                                                <div class="modal fade" id="deleteModal{{ $message->id }}" tabindex="-1"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Confirm Deletion</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Are you sure you want to delete this message from
                                                                    <strong>{{ $message->name }}</strong>?
                                                                </p>
                                                                <p class="text-danger">This action cannot be undone.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Cancel</button>
                                                                <form
                                                                    action="{{ route('admin.contacts.destroy', $message->id) }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="btn btn-danger">Delete</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>

                    <!-- Delete Multiple Modal -->
                    <div class="modal fade" id="deleteMultipleModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Confirm Multiple Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete the selected messages?</p>
                                    <p class="text-danger">This action cannot be undone.</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger" id="confirmDeleteMultiple">Delete All
                                        Selected</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info mb-0">
                        <i class="fas fa-info-circle me-2"></i> No messages found.
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Select all functionality
        const selectAllCheckbox = document.getElementById('selectAll');
        const messageCheckboxes = document.querySelectorAll('.message-checkbox');
        const deleteSelectedBtn = document.getElementById('deleteSelectedBtn');
        const deleteMultipleForm = document.getElementById('deleteMultipleForm');
        const confirmDeleteMultipleBtn = document.getElementById('confirmDeleteMultiple');

        selectAllCheckbox?.addEventListener('change', function() {
            const isChecked = this.checked;

            messageCheckboxes.forEach(checkbox => {
                checkbox.checked = isChecked;
            });

            updateDeleteButtonState();
        });

        messageCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateDeleteButtonState);
        });

        function updateDeleteButtonState() {
            const checkedCount = document.querySelectorAll('.message-checkbox:checked').length;
            deleteSelectedBtn.disabled = checkedCount === 0;
        }

        confirmDeleteMultipleBtn?.addEventListener('click', function() {
            deleteMultipleForm.submit();
        });
    </script>
@endsection
