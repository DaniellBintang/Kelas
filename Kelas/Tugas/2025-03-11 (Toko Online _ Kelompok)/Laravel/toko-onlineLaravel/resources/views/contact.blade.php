@extends('layouts.app')

@section('title', 'Contact Us - Guitar Shop')

@section('styles')
    <style>
        .contact-section {
            padding: 5rem 0;
            margin-top: 2rem;
            background-color: #f8f9fa;
        }

        .contact-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .contact-info {
            background: var(--primary-color);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            height: 100%;
        }

        .contact-info-item {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .contact-info-item i {
            font-size: 1.5rem;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form-control {
            padding: 0.8rem;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            margin-bottom: 1rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(227, 24, 35, 0.25);
            border-color: var(--primary-color);
        }

        .form-control:disabled {
            background-color: #e9ecef;
            opacity: 0.8;
        }

        .submit-btn {
            background-color: var(--primary-color);
            color: white;
            padding: 0.8rem 2rem;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #c41820;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 8px;
            margin-bottom: 1.5rem;
        }

        .auto-filled-badge {
            background-color: #28a745;
            color: white;
            font-size: 0.75rem;
            padding: 0.2rem 0.5rem;
            border-radius: 12px;
            margin-left: 0.5rem;
        }

        .user-info-section {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }

        .edit-profile-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .edit-profile-link:hover {
            text-decoration: underline;
        }
    </style>
@endsection

@section('content')
    <section class="contact-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="row">
                        <div class="col-md-6 mb-4 mb-md-0">
                            <div class="contact-info">
                                <h2 class="mb-4">Get in Touch</h2>
                                <div class="contact-info-item">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <div>
                                        <h5 class="mb-0">Our Location</h5>
                                        <p class="mb-0">123 Guitar Street, Music City</p>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <i class="fas fa-phone"></i>
                                    <div>
                                        <h5 class="mb-0">Phone Number</h5>
                                        <p class="mb-0">(555) 123-4567</p>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <i class="fas fa-envelope"></i>
                                    <div>
                                        <h5 class="mb-0">Email Address</h5>
                                        <p class="mb-0">info@guitarshop.com</p>
                                    </div>
                                </div>
                                <div class="contact-info-item">
                                    <i class="fas fa-clock"></i>
                                    <div>
                                        <h5 class="mb-0">Working Hours</h5>
                                        <p class="mb-0">Mon - Fri: 9:00 AM - 6:00 PM</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="contact-card">
                                <h2 class="mb-4">Send us a Message</h2>

                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <!-- User Info Section -->
                                <div class="user-info-section">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h6 class="mb-1">
                                                <i class="fas fa-user me-2"></i>Contacting as: {{ $user->full_name }}
                                            </h6>
                                            <small class="text-muted">{{ $user->email }}</small>
                                        </div>
                                        <a href="{{ route('profile.edit') }}" class="edit-profile-link">
                                            <i class="fas fa-edit me-1"></i>Edit Profile
                                        </a>
                                    </div>
                                </div>

                                <form action="{{ route('contact.store') }}" method="POST" id="contactForm">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="name" class="form-label">
                                            Name
                                            <span class="auto-filled-badge">
                                                <i class="fas fa-check me-1"></i>Auto-filled
                                            </span>
                                        </label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $user->full_name) }}"
                                            required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">You can edit this if needed</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            Email
                                            <span class="auto-filled-badge">
                                                <i class="fas fa-check me-1"></i>Auto-filled
                                            </span>
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">You can edit this if needed</small>
                                    </div>

                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message *</label>
                                        <textarea class="form-control @error('message') is-invalid @enderror" id="message" name="message" rows="5"
                                            placeholder="Please enter your message here..." required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="submit-btn">
                                        <i class="fas fa-paper-plane me-2"></i> Send Message
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Message Sent!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <i class="fas fa-check-circle text-success fa-3x mb-3"></i>
                        <p>Your message has been sent successfully! We will get back to you soon.</p>
                        <small class="text-muted">We'll respond to {{ $user->email }}</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show modal if message was sent successfully
            @if (session('success'))
                const successModal = new bootstrap.Modal(document.getElementById('successModal'));
                successModal.show();
            @endif

            // Optional: Add confirmation before sending
            document.getElementById('contactForm').addEventListener('submit', function(e) {
                const message = document.getElementById('message').value.trim();
                if (message.length < 10) {
                    e.preventDefault();
                    alert('Please enter a more detailed message (at least 10 characters).');
                    return false;
                }
            });

            // Auto-resize textarea
            const messageTextarea = document.getElementById('message');
            messageTextarea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
        });
    </script>
@endsection
