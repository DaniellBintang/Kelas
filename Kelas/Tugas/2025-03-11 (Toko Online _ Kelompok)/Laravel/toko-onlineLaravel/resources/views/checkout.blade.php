@extends('layouts.app')

@section('title', 'Checkout')

@section('styles')
    <style>
        .checkout-container {
            padding: 2rem 0;
            margin-top: 5rem;
        }

        .checkout-section {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .product-summary {
            display: flex;
            align-items: flex-start;
            padding: 1rem 0;
            border-bottom: 1px solid #eee;
            gap: 1.5rem;
        }

        .product-summary:last-child {
            border-bottom: none;
        }

        .product-summary img {
            width: 100px;
            height: 100px;
            object-fit: contain;
            border: 1px solid #eee;
            background: #fff;
            padding: 5px;
            border-radius: 4px;
        }

        .product-summary-content {
            flex: 1;
        }

        .address-option {
            border: 2px solid #ddd;
            padding: 1rem;
            margin: 0.5rem 0;
            border-radius: 8px;
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }

        .address-option:hover {
            border-color: #dc3545;
            background-color: #f8f9fa;
        }

        .address-option.selected {
            border-color: #dc3545;
            background-color: #fff5f5;
        }

        .address-radio {
            position: absolute;
            top: 1rem;
            right: 1rem;
            width: 20px;
            height: 20px;
            cursor: pointer;
        }

        .new-address-form {
            display: none;
            margin-top: 1rem;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f8f9fa;
        }

        .new-address-form.active {
            display: block;
        }

        .checkout-btn {
            width: 100%;
            padding: 1rem;
            font-weight: 500;
            background-color: #dc3545;
            border: none;
            transition: all 0.3s ease;
        }

        .checkout-btn:hover {
            background-color: #c82333;
        }

        .order-summary {
            position: sticky;
            top: 6rem;
        }

        @media (max-width: 768px) {
            .product-summary {
                flex-direction: column;
                gap: 1rem;
            }

            .product-summary img {
                width: 80px;
                height: 80px;
                align-self: center;
            }

            .order-summary {
                position: relative;
                top: auto;
            }
        }
    </style>
@endsection

@section('content')
    <div class="checkout-container">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mb-4">Checkout</h2>
                </div>
            </div>

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Shipping Address Section -->
                        <div class="checkout-section">
                            <h4 class="mb-3">
                                <i class="fas fa-map-marker-alt me-2"></i>Shipping Address
                            </h4>

                            <!-- Default Address -->
                            <div class="address-option selected" data-address="default">
                                <input type="radio" name="address_id" value="default" class="address-radio" checked>
                                <div class="address-content">
                                    <h6 class="mb-2">
                                        <i class="fas fa-home me-2"></i>Main Address
                                    </h6>
                                    <p class="mb-1"><strong>{{ $user->full_name }}</strong></p>
                                    <p class="mb-1">{{ $user->address }}</p>
                                    <p class="mb-0">{{ $user->city }}, {{ $user->postal_code }}</p>
                                </div>
                            </div>

                            <!-- Additional Addresses -->
                            @foreach ($additionalAddresses as $address)
                                <div class="address-option" data-address="{{ $address->id }}">
                                    <input type="radio" name="address_id" value="{{ $address->id }}"
                                        class="address-radio">
                                    <div class="address-content">
                                        <h6 class="mb-2">
                                            <i class="fas fa-building me-2"></i>Additional Address
                                        </h6>
                                        <p class="mb-1">{{ $address->address }}</p>
                                        <p class="mb-0">{{ $address->city }}, {{ $address->postal_code }}</p>
                                    </div>
                                </div>
                            @endforeach

                            <!-- New Address Option -->
                            <div class="address-option" data-address="new">
                                <input type="radio" name="use_new_address" value="1" class="address-radio">
                                <div class="address-content">
                                    <h6 class="mb-2">
                                        <i class="fas fa-plus-circle me-2"></i>Use New Address
                                    </h6>
                                    <p class="mb-0 text-muted">Enter a new shipping address</p>
                                </div>
                            </div>

                            <!-- New Address Form -->
                            <div class="new-address-form">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <label class="form-label">Full Address</label>
                                        <textarea name="new_address" class="form-control @error('new_address') is-invalid @enderror" rows="3"
                                            placeholder="Enter your complete address"></textarea>
                                        @error('new_address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" name="new_city"
                                            class="form-control @error('new_city') is-invalid @enderror"
                                            placeholder="Enter city">
                                        @error('new_city')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Postal Code</label>
                                        <input type="text" name="new_postal_code"
                                            class="form-control @error('new_postal_code') is-invalid @enderror"
                                            placeholder="Enter postal code">
                                        @error('new_postal_code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input type="checkbox" name="save_address" value="1"
                                                class="form-check-input" id="saveAddress">
                                            <label class="form-check-label" for="saveAddress">
                                                Save this address for future use
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order Summary Section -->
                        <div class="checkout-section">
                            <h4 class="mb-3">
                                <i class="fas fa-shopping-bag me-2"></i>Order Summary
                            </h4>

                            @foreach ($cartItems as $item)
                                <div class="product-summary">
                                    <img src="{{ asset('uploads/' . $item['product']->image) }}"
                                        alt="{{ $item['product']->name }}">
                                    <div class="product-summary-content">
                                        <h6 class="mb-2">{{ $item['product']->name }}</h6>
                                        <p class="mb-1 text-muted">Quantity: {{ $item['quantity'] }}</p>
                                        <p class="mb-0">
                                            <span class="text-muted">Price: </span>
                                            <span class="fw-bold">Rp
                                                {{ number_format($item['product']->price, 0, ',', '.') }}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="text-muted">Subtotal: </span>
                                            <span class="fw-bold text-danger">Rp
                                                {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <!-- Payment Summary -->
                        <div class="checkout-section order-summary">
                            <h4 class="mb-3">
                                <i class="fas fa-receipt me-2"></i>Payment Summary
                            </h4>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Shipping</span>
                                <span class="text-success">Free</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Tax</span>
                                <span>Rp 0</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between mb-4">
                                <strong>Total</strong>
                                <strong class="text-danger fs-5">Rp {{ number_format($totalPrice, 0, ',', '.') }}</strong>
                            </div>

                            <button type="submit" class="btn btn-danger checkout-btn">
                                <i class="fas fa-credit-card me-2"></i>Place Order
                            </button>

                            <div class="text-center mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-lock me-1"></i>
                                    Your payment information is secure
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addressOptions = document.querySelectorAll('.address-option');
            const newAddressForm = document.querySelector('.new-address-form');
            let currentSelectedOption = document.querySelector('.address-option[data-address="default"]');

            function updateSelectedState(selectedOption) {
                // Remove selected class from all options
                addressOptions.forEach(opt => {
                    opt.classList.remove('selected');
                    const radio = opt.querySelector('input[type="radio"]');
                    if (radio) radio.checked = false;
                });

                // Add selected class to clicked option
                selectedOption.classList.add('selected');
                const radio = selectedOption.querySelector('input[type="radio"]');
                if (radio) radio.checked = true;

                // Update currentSelectedOption
                currentSelectedOption = selectedOption;

                // Handle new address form visibility
                if (selectedOption.dataset.address === 'new') {
                    newAddressForm.classList.add('active');
                    // Make new address fields required
                    newAddressForm.querySelectorAll('input[required], textarea[required]').forEach(input => {
                        input.setAttribute('required', 'required');
                    });
                } else {
                    newAddressForm.classList.remove('active');
                    // Remove required attribute from new address fields
                    newAddressForm.querySelectorAll('input, textarea').forEach(input => {
                        input.removeAttribute('required');
                    });
                }
            }

            addressOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    // Don't trigger if clicking on radio button directly
                    if (e.target.type !== 'radio') {
                        updateSelectedState(this);
                    }
                });

                // Handle radio button change
                const radio = option.querySelector('input[type="radio"]');
                if (radio) {
                    radio.addEventListener('change', function() {
                        if (this.checked) {
                            updateSelectedState(option);
                        }
                    });
                }
            });

            // Reset form fields when switching away from new address
            addressOptions.forEach(option => {
                if (option.dataset.address !== 'new') {
                    option.addEventListener('click', function() {
                        const form = document.querySelector('.new-address-form');
                        form.querySelectorAll('input:not([type="checkbox"]), textarea').forEach(
                            input => {
                                input.value = '';
                            });
                        form.querySelector('input[type="checkbox"]').checked = false;
                    });
                }
            });

            // Form validation
            document.getElementById('checkoutForm').addEventListener('submit', function(e) {
                const newAddressOption = document.querySelector('.address-option[data-address="new"]');

                if (newAddressOption.classList.contains('selected')) {
                    const newAddress = document.querySelector('textarea[name="new_address"]').value.trim();
                    const newCity = document.querySelector('input[name="new_city"]').value.trim();
                    const newPostalCode = document.querySelector('input[name="new_postal_code"]').value
                        .trim();

                    if (!newAddress || !newCity || !newPostalCode) {
                        e.preventDefault();
                        alert('Please fill in all address fields.');
                        return false;
                    }
                }
            });
        });
    </script>
@endsection
