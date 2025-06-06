{{-- resources/views/admin/products/index.blade.php --}}

@extends('layouts.admin')

@section('title', 'Manage Products')

@section('styles')
    <style>
        .product-image-container {
            width: 100px;
            height: 100px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            object-position: center;
        }

        .table td {
            vertical-align: middle;
        }

        .image-preview {
            max-width: 100%;
            height: 150px;
            object-fit: contain;
            margin-top: 10px;
            display: none;
        }
    </style>
@endsection

@section('content')
    <div class="dashboard-header">
        <div class="dashboard-icon">
            <i class="fas fa-guitar"></i>
        </div>
        <h1>Manage Products</h1>
        <p>Add, edit, or delete products from your inventory</p>
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
        <div class="row">
            <div class="col-md-4">
                <!-- Product Form -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title" id="form_title">Add New Product</h5>
                    </div>
                    <div class="card-body">
                        <form id="productForm" action="{{ route('admin.products.store') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div id="method_field"></div>
                            <input type="hidden" name="id" id="product_id">

                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="product_name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="product_price" class="form-label">Price</label>
                                <input type="number" step="0.01" min="0"
                                    class="form-control @error('price') is-invalid @enderror" id="product_price"
                                    name="price" value="{{ old('price') }}" required>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Stock Field -->
                            <div class="mb-3">
                                <label for="product_stock" class="form-label">Stock</label>
                                <input type="number" min="0"
                                    class="form-control @error('stock') is-invalid @enderror" id="product_stock"
                                    name="stock" value="{{ old('stock', 0) }}" required>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="product_image" class="form-label">Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="product_image" name="image" accept="image/*">
                                <small class="form-text text-muted" id="image_help">Upload an image for the product.</small>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                <!-- Image Preview -->
                                <img id="image_preview" class="image-preview" src="#" alt="Product Preview">
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary" id="submit_btn">Add Product</button>
                                <button type="button" class="btn btn-secondary d-none" id="cancel_btn"
                                    onclick="resetForm()">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <!-- Products Table -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">All Products</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>Price</th>
                                        <th>Stock</th> <!-- Tambahkan kolom stock -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($products as $product)
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->name }}</td>
                                            <td>
                                                <div class="product-image-container">
                                                    <img src="{{ asset('uploads/' . $product->image) }}"
                                                        class="product-image" alt="{{ $product->name }}">
                                                </div>
                                            </td>
                                            <td>Rp {{ number_format($product->price, 2) }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-warning btn-sm"
                                                        onclick="editProduct({{ $product->id }}, '{{ $product->name }}', {{ $product->price }}, '{{ $product->image }}')">
                                                        <i class="fas fa-edit"></i> Edit
                                                    </button>

                                                    <form action="{{ route('admin.products.destroy', $product->id) }}"
                                                        method="POST" class="d-inline-block"
                                                        onsubmit="return confirm('Are you sure you want to delete this product?');">
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
                                            <td colspan="5" class="text-center">No products found</td>
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
        function editProduct(id, name, price, image, stock) {
            // Update form for editing
            document.getElementById('form_title').innerText = 'Edit Product';
            document.getElementById('productForm').action = `{{ url('admin/products') }}/${id}`;
            document.getElementById('product_id').value = id;
            document.getElementById('product_name').value = name;
            document.getElementById('product_price').value = price;
            document.getElementById('product_stock').value = stock; // Tambahkan ini
            document.getElementById('product_image').required = false;
            document.getElementById('image_help').innerText = 'Leave empty to keep current image.';
            document.getElementById('submit_btn').innerText = 'Update Product';
            document.getElementById('cancel_btn').classList.remove('d-none');

            // Add method field for update
            const methodField = document.getElementById('method_field');
            methodField.innerHTML = `@method('PUT')`;

            // Scroll to form
            document.querySelector('.card-header').scrollIntoView({
                behavior: 'smooth'
            });
        }

        function resetForm() {
            // Reset form to add mode
            document.getElementById('form_title').innerText = 'Add New Product';
            document.getElementById('productForm').action = "{{ route('admin.products.store') }}";
            document.getElementById('productForm').reset();
            document.getElementById('product_image').required = true;
            document.getElementById('image_help').innerText = 'Upload an image for the product.';
            document.getElementById('submit_btn').innerText = 'Add Product';
            document.getElementById('cancel_btn').classList.add('d-none');
            document.getElementById('method_field').innerHTML = '';
            document.getElementById('image_preview').style.display = 'none';
        }

        // Image preview
        document.getElementById('product_image').addEventListener('change', function(e) {
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
