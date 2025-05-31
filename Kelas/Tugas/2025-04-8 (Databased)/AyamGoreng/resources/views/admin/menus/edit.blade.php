<!-- resources/views/admin/menus/edit.blade.php -->
@extends('layouts.admin')

@section('title', 'Edit Menu')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('admin.menus.index') }}">Daftar Menu</a></li>
    <li class="breadcrumb-item active">Edit Menu</li>
@endsection

@section('page-title', 'Edit Menu')

@section('sidebar')
    <a href="{{ route('admin.dashboard') }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <i class="fas fa-tachometer-alt me-2"></i>Dashboard
    </a>
    <a href="{{ route('admin.users.index') ?? '#' }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <i class="fas fa-users me-2"></i>Users
    </a>
    <a href="{{ route('admin.menus.index') ?? '#' }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
        <i class="fas fa-utensils me-2"></i>Menu
    </a>
    <a href="{{ route('admin.orders.index') ?? '#' }}"
        class="list-group-item list-group-item-action {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
        <i class="fas fa-shopping-cart me-2"></i>Orders
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Menu</h5>
                <div>
                    <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary btn-sm me-2">
                        <i class="fas fa-arrow-left me-1"></i>Kembali
                    </a>
                    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus me-1"></i>Tambah Menu Baru
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <div><strong><i class="fas fa-exclamation-triangle me-2"></i>Terjadi kesalahan!</strong></div>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-4">
                            <label for="name" class="form-label">Nama Menu <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name"
                                class="form-control form-control-lg @error('name') is-invalid @enderror"
                                placeholder="Masukkan nama menu" value="{{ old('name', $menu->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                rows="5" placeholder="Deskripsi menu...">{{ old('description', $menu->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Tambahkan deskripsi yang menarik untuk menu Anda.</small>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Harga <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="price" id="price"
                                        class="form-control @error('price') is-invalid @enderror" placeholder="0"
                                        value="{{ old('price', $menu->price) }}" required>
                                </div>
                                @error('price')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="category" class="form-label">Kategori</label>
                                <select name="category" id="category"
                                    class="form-select @error('category') is-invalid @enderror">
                                    <option value="" disabled>Pilih kategori</option>
                                    <option value="1" {{ $menu->category_id == 1 ? 'selected' : '' }}>Makanan Utama
                                    </option>
                                    <option value="2" {{ $menu->category_id == 2 ? 'selected' : '' }}>Appetizer
                                    </option>
                                    <option value="3" {{ $menu->category_id == 3 ? 'selected' : '' }}>Dessert</option>
                                    <option value="4" {{ $menu->category_id == 4 ? 'selected' : '' }}>Minuman</option>
                                </select>
                                @error('category')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="mb-0">Gambar Menu</h6>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <img id="preview" src="{{ asset($menu->image) }}" class="img-fluid rounded border"
                                        style="max-height: 200px">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Ganti Gambar</label>
                                    <input type="file" name="image" id="image"
                                        class="form-control @error('image') is-invalid @enderror" accept="image/*"
                                        onchange="previewImage()">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted">
                                    <i class="fas fa-info-circle me-1"></i>Biarkan kosong jika tidak ingin mengganti
                                    gambar.
                                </small>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-header">
                                <h6 class="mb-0">Status & Visibilitas</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_available"
                                            name="is_available" {{ $menu->is_available ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_available">Tersedia</label>
                                    </div>
                                    <small class="text-muted">Menu ini tersedia untuk dipesan.</small>
                                </div>
                                <div class="mb-3">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_featured"
                                            name="is_featured" {{ $menu->is_featured ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">Menu Unggulan</label>
                                    </div>
                                    <small class="text-muted">Tampilkan di bagian menu unggulan.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4 border-top pt-4">
                    <button type="button" class="btn btn-outline-secondary me-2" onclick="window.history.back()">
                        <i class="fas fa-times me-1"></i>Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i>Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function previewImage() {
            const preview = document.getElementById('preview');
            const file = document.getElementById('image').files[0];
            const reader = new FileReader();

            reader.onload = function() {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Format harga saat input
            const priceInput = document.getElementById('price');
            priceInput.addEventListener('input', function() {
                // Hapus karakter non-numerik
                let value = this.value.replace(/[^\d]/g, '');
                // Format dengan separator ribuan
                if (value.length > 3) {
                    this.value = parseInt(value).toLocaleString('id-ID');
                } else {
                    this.value = value;
                }
            });

            // Reset format saat form disubmit
            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                priceInput.value = priceInput.value.replace(/\./g, '');
            });

            // Konfirmasi saat batal
            const cancelButton = document.querySelector('button[onclick="window.history.back()"]');
            cancelButton.addEventListener('click', function(e) {
                const isFormChanged = checkFormChanged();

                if (isFormChanged) {
                    if (!confirm('Perubahan belum disimpan. Yakin ingin membatalkan?')) {
                        e.preventDefault();
                    }
                }
            });

            // Fungsi untuk memeriksa apakah form diubah
            function checkFormChanged() {
                // Simpan nilai awal form
                const initialForm = {
                    name: '{{ $menu->name }}',
                    description: '{{ addslashes($menu->description) }}',
                    price: '{{ $menu->price }}',
                    category: '{{ $menu->category_id }}',
                    is_available: {{ $menu->is_available ? 'true' : 'false' }},
                    is_featured: {{ $menu->is_featured ? 'true' : 'false' }}
                };

                // Bandingkan dengan nilai saat ini
                return (
                    document.getElementById('name').value !== initialForm.name ||
                    document.getElementById('description').value !== initialForm.description ||
                    document.getElementById('price').value.replace(/\./g, '') !== initialForm.price ||
                    document.getElementById('category').value !== initialForm.category ||
                    document.getElementById('is_available').checked !== initialForm.is_available ||
                    document.getElementById('is_featured').checked !== initialForm.is_featured ||
                    document.getElementById('image').files.length > 0
                );
            }
        });
    </script>
@endsection
