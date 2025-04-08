@extends('layouts.app')

@section('head_extras')
    <style>
        .checkout-section {
            padding: 60px 0;
        }

        .checkout-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
        }

        .order-summary {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        .order-total {
            font-size: 1.2rem;
            font-weight: 700;
            margin-top: 20px;
            text-align: right;
        }

        .btn-place-order {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 10px 30px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-place-order:hover {
            background-color: #45b7aa;
            color: white;
        }
    </style>
@endsection

@section('content')
    <div class="checkout-section">
        <div class="container">
            <h1>Checkout</h1>

            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Informasi Pengiriman</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('checkout.process') }}" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="name">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', Auth::user()->name) }}"
                                        required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- filepath: e:\xampp\htdocs\AyamGoreng\resources\views\checkout.blade.php --}}
                                <div class="form-group mb-3">
                                    <label for="phone">Nomor Telepon</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone', Auth::user()->phone) }}"
                                        required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="address">Alamat Pengiriman</label>
                                    <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                        required>{{ old('address', Auth::user()->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label>Metode Pembayaran</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cash"
                                            value="cash" checked>
                                        <label class="form-check-label" for="cash">
                                            Bayar di Tempat (COD)
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="payment_method" id="transfer"
                                            value="transfer">
                                        <label class="form-check-label" for="transfer">
                                            Transfer Bank
                                        </label>
                                    </div>
                                    @error('payment_method')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group text-end">
                                    <a href="{{ route('cart.index') }}" class="btn btn-secondary me-2">Kembali ke
                                        Keranjang</a>
                                    <button type="submit" class="btn btn-place-order">Pesan Sekarang</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="order-summary">
                        <h5 class="mb-3">Ringkasan Pesanan</h5>

                        @php
                            $totalPrice = 0;
                        @endphp

                        @foreach (session('cart') as $id => $details)
                            @php
                                $itemTotal = $details['price'] * $details['quantity'];
                                $totalPrice += $itemTotal;
                            @endphp
                            <div class="order-item">
                                <div>
                                    <p class="mb-0">{{ $details['name'] }} x {{ $details['quantity'] }}</p>
                                </div>
                                <div>
                                    <p class="mb-0">Rp {{ number_format($itemTotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        @endforeach

                        <hr>

                        <div class="order-total">
                            <p>Total: <span class="text-primary">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
