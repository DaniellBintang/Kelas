@extends('layouts.admin')

@section('title', 'Daftar Kontak')

@section('breadcrumbs')
    <li class="breadcrumb-item active">Kontak</li>
@endsection

@section('page-title', 'Manajemen Pesan Kontak')

@section('css')
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            border: none;
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f1f1f1;
            padding: 1rem 1.5rem;
        }

        .header-action {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(74, 111, 220, 0.05);
        }

        .badge-status {
            padding: 0.5em 0.8em;
            font-weight: 500;
            font-size: 0.75rem;
        }

        .message-preview {
            max-width: 250px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            line-height: 1.5;
        }

        .btn-action {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            margin-right: 0.25rem;
        }

        .card-footer {
            background-color: #fff;
            border-top: 1px solid #f1f1f1;
            padding: 1rem 1.5rem;
        }

        .pagination {
            margin-bottom: 0;
        }

        .empty-state {
            padding: 3rem 0;
            text-align: center;
        }

        .empty-state-icon {
            font-size: 3rem;
            color: #d9d9d9;
            margin-bottom: 1rem;
        }

        .empty-state-text {
            color: #6c757d;
        }

        .contact-detail-modal .modal-header {
            border-bottom: 1px solid #f1f1f1;
        }

        .contact-detail-modal .modal-footer {
            border-top: 1px solid #f1f1f1;
        }

        .contact-info {
            margin-bottom: 1.5rem;
        }

        .contact-info h6 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .contact-message {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 0.375rem;
            margin-bottom: 1.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="header-action">
                <h5 class="mb-0">Pesan Kontak</h5>
                <div>
                    <form action="{{ route('admin.contacts.index') }}" method="GET" class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control"
                                placeholder="Cari berdasarkan nama, email, atau isi pesan..." name="search"
                                value="{{ request('search') }}" aria-label="Search contacts">
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            @if (request('search'))
                                <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-times"></i> Clear
                                </a>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            @if (request('search'))
                <div class="mt-3">
                    <div class="alert alert-info d-flex align-items-center mb-0">
                        <i class="fas fa-search me-2"></i>
                        <div>
                            Hasil pencarian untuk: "{{ request('search') }}"
                            <span class="badge bg-secondary ms-2">{{ $contacts->total() }} hasil</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>


        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($contacts->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="15%">Nama</th>
                                <th width="15%">Email</th>
                                <th width="30%">Pesan</th>
                                <th width="15%">Tanggal</th>
                                <th width="10%">Status</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contacts as $index => $contact)
                                <tr>
                                    <td>{{ $contacts->firstItem() + $index }}</td>
                                    <td>{{ $contact->name }}</td>
                                    <td><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></td>
                                    <td>
                                        <div class="message-preview">{{ $contact->message }}</div>
                                    </td>
                                    <td>{{ $contact->created_at->format('d M Y, H:i') }}</td>
                                    <td>
                                        @if (isset($contact->read_at))
                                            <span class="badge bg-success badge-status">Dibaca</span>
                                        @else
                                            <span class="badge bg-warning badge-status">Belum Dibaca</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-sm btn-primary btn-action me-1"
                                                data-bs-toggle="modal" data-bs-target="#viewModal{{ $contact->id }}">
                                                <i class="fas fa-eye"></i>
                                            </button>

                                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger btn-action">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- View Modal -->
                                        <div class="modal fade contact-detail-modal" id="viewModal{{ $contact->id }}"
                                            tabindex="-1" aria-labelledby="viewModalLabel{{ $contact->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="viewModalLabel{{ $contact->id }}">
                                                            Detail Pesan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="contact-info">
                                                            <h6>Nama:</h6>
                                                            <p>{{ $contact->name }}</p>
                                                        </div>
                                                        <div class="contact-info">
                                                            <h6>Email:</h6>
                                                            <p><a
                                                                    href="mailto:{{ $contact->email }}">{{ $contact->email }}</a>
                                                            </p>
                                                        </div>
                                                        @if (isset($contact->phone))
                                                            <div class="contact-info">
                                                                <h6>Telepon:</h6>
                                                                <p><a
                                                                        href="tel:{{ $contact->phone }}">{{ $contact->phone }}</a>
                                                                </p>
                                                            </div>
                                                        @endif
                                                        <div class="contact-info">
                                                            <h6>Tanggal:</h6>
                                                            <p>{{ $contact->created_at->format('d M Y, H:i') }}</p>
                                                        </div>
                                                        <div class="contact-info">
                                                            <h6>Pesan:</h6>
                                                            <div class="contact-message">
                                                                {{ $contact->message }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tutup</button>
                                                        <a href="mailto:{{ $contact->email }}?subject=Balasan: {{ $contact->subject ?? 'Pesan dari Website' }}"
                                                            class="btn btn-primary">
                                                            <i class="fas fa-reply me-1"></i> Balas
                                                        </a>
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
            @else
                <div class="empty-state">
                    <div class="empty-state-icon">
                        <i class="fas fa-envelope-open"></i>
                    </div>
                    @if (request('search'))
                        <h5>Tidak Ada Hasil</h5>
                        <p class="empty-state-text">
                            Tidak ada pesan yang sesuai dengan pencarian "{{ request('search') }}"
                        </p>
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary mt-3">
                            <i class="fas fa-times me-1"></i> Reset Pencarian
                        </a>
                    @else
                        <h5>Belum Ada Pesan</h5>
                        <p class="empty-state-text">Saat ini belum ada pesan kontak yang diterima.</p>
                    @endif
                </div>
            @endif
        </div>
        @if ($contacts->count() > 0)
            <div class="card-footer">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        Menampilkan {{ $contacts->firstItem() }} sampai {{ $contacts->lastItem() }} dari
                        {{ $contacts->total() }} pesan
                    </div>
                    <div>
                        {{ $contacts->links() }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        // Mark contact as read when modal is opened
        document.addEventListener('DOMContentLoaded', function() {
            const viewModals = document.querySelectorAll('[id^="viewModal"]');
            viewModals.forEach(modal => {
                modal.addEventListener('shown.bs.modal', function() {
                    const contactId = this.id.replace('viewModal', '');
                    markAsRead(contactId);
                });
            });
        });

        function markAsRead(contactId) {
            // Here you would typically make an AJAX call to mark the contact as read
            // This is a placeholder function that you would implement with actual backend logic
            fetch(`/admin/contacts/${contactId}/mark-read`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // You could update the UI here if needed
                        console.log('Marked as read successfully');
                    }
                })
                .catch(error => {
                    console.error('Error marking contact as read:', error);
                });
        }
    </script>
@endsection
