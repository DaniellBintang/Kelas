@extends('layouts.admin')

@section('title', 'Manage Banners')

@section('styles')
    <style>
        table img {
            width: 120px;
            height: 80px;
            object-fit: contain;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        #current_banner_image {
            width: 280px;
            height: 220px;
            object-fit: contain;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .banner-preview {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-header">
        <div class="dashboard-icon">
            <i class="fas fa-images"></i>
        </div>
        <h1>Manage Banners</h1>
        <p>Add and manage promotional banners</p>
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

    <div class="content-container">
        <div class="row">
            <div class="col-md-4">
                <!-- Banner Form -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" id="form_title">Add New Banner</h5>
                    </div>
                    <div class="card-body">
                        <form id="bannerForm" action="{{ route('admin.banners.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div id="method_field"></div>
                            <input type="hidden" id="banner_id" name="banner_id">

                            <div class="mb-3">
                                <label class="form-label">Banner Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    name="image" id="banner_image">
                                <small class="text-muted">Leave empty to keep current image when updating</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Image Preview -->
                                <img id="image_preview" class="banner-preview" src="#" alt="Banner Preview">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Banner Type</label>
                                <select name="type" class="form-control @error('type') is-invalid @enderror"
                                    id="banner_type" required>
                                    <option value="static">Static</option>
                                    <option value="dynamic">Dynamic</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary" id="submit_btn">Add Banner</button>
                                <button type="button" class="btn btn-secondary d-none" id="cancel_btn"
                                    onclick="resetForm()">
                                    Cancel
                                </button>
                            </div>
                        </form>

                        <div class="mb-3 mt-4">
                            <label class="form-label">Current Banner Image</label>
                            <img src="" id="current_banner_image" class="d-none">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <!-- Banners Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">All Banners</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>Type</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($banners as $banner)
                                        <tr>
                                            <td>{{ $banner->id }}</td>
                                            <td>
                                                <img src="{{ asset('images/' . $banner->image) }}" alt="Banner">
                                            </td>
                                            <td>{{ ucfirst($banner->type) }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-warning btn-sm"
                                                        onclick="editBanner({{ $banner->id }}, '{{ $banner->image }}', '{{ $banner->type }}')">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>

                                                    <form action="{{ route('admin.banners.destroy', $banner->id) }}"
                                                        method="POST" class="d-inline-block"
                                                        onsubmit="return confirm('Are you sure you want to delete this banner?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fas fa-trash"></i> Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No banners found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function editBanner(id, image, type) {
            // Update form for editing
            document.getElementById('form_title').innerText = 'Edit Banner';
            document.getElementById('bannerForm').action = `{{ url('admin/banners') }}/${id}`;
            document.getElementById('banner_id').value = id;
            document.getElementById('banner_type').value = type;
            document.getElementById('banner_image').required = false;
            document.getElementById('submit_btn').innerText = 'Update Banner';
            document.getElementById('cancel_btn').classList.remove('d-none');

            // Add method field for update
            const methodField = document.getElementById('method_field');
            methodField.innerHTML = `@method('PATCH')`;

            // Show current image
            const currentImage = document.getElementById('current_banner_image');
            currentImage.src = `{{ asset('storage/images') }}/${image}`;
            currentImage.classList.remove('d-none');

            // Scroll to form
            document.querySelector('.card-header').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function resetForm() {
            // Reset form to add mode
            document.getElementById('form_title').innerText = 'Add New Banner';
            document.getElementById('bannerForm').action = "{{ route('admin.banners.store') }}";
            document.getElementById('bannerForm').reset();
            document.getElementById('banner_image').required = true;
            document.getElementById('submit_btn').innerText = 'Add Banner';
            document.getElementById('cancel_btn').classList.add('d-none');
            document.getElementById('method_field').innerHTML = '';

            // Hide current image
            document.getElementById('current_banner_image').classList.add('d-none');
            document.getElementById('image_preview').style.display = 'none';
        }

        // Image preview
        document.getElementById('banner_image').addEventListener('change', function(e) {
            const preview = document.getElementById('image_preview');
            const file = e.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
    </script>
@endsection
