@extends('layouts.app')

@section('head_extras')
    <style>
        .cart-section {
            padding: 60px 0;
        }

        .cart-section h1 {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 40px;
        }

        .cart-item {
            border-bottom: 1px solid #eee;
            padding: 20px 0;
        }

        .cart-item-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 8px;
        }

        .cart-item-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-item-price {
            font-weight: 600;
            color: var(--secondary-color);
        }

        .cart-total {
            font-size: 1.2rem;
            font-weight: 700;
            text-align: right;
            margin: 20px 0;
        }

        .btn-checkout {
            background-color: var(--secondary-color);
            color: white;
            font-weight: 600;
            padding: 10px 30px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .btn-checkout:hover {
            background-color: #45b7aa;
            color: white;
        }

        .quantity-input::-webkit-inner-spin-button,
        .quantity-input::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .cart-empty {
            text-align: center;
            padding: 50px 0;
        }

        .quantity-input {
            width: 60px;
            display: inline-block;
        }
    </style>
@endsection

@section('content')
    <div class="cart-section">
        <div class="container">
            <h1>Keranjang Belanja</h1>

            @if (session('cart') && count(session('cart')) > 0)
                <div class="cart-items">
                    @php
                        $totalPrice = 0;
                    @endphp

                    @foreach (session('cart') as $id => $details)
                        @php
                            $totalPrice += $details['price'] * $details['quantity'];
                        @endphp
                        <div class="cart-item" data-id="{{ $id }}">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="{{ asset($details['image']) }}" alt="{{ $details['name'] }}"
                                        class="cart-item-img">
                                </div>
                                <div class="col-md-4">
                                    <h5>{{ $details['name'] }}</h5>
                                    <p class="text-muted">{{ $details['description'] }}</p>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group">
                                        <button class="btn btn-sm btn-outline-secondary update-cart decrease-quantity"
                                            data-id="{{ $id }}">-</button>
                                        <input type="number" value="{{ $details['quantity'] }}"
                                            class="form-control quantity-input quantity text-center" min="1"
                                            data-id="{{ $id }}">
                                        <button class="btn btn-sm btn-outline-secondary update-cart increase-quantity"
                                            data-id="{{ $id }}">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2 text-right">
                                    <span class="cart-item-price">Rp
                                        {{ number_format($details['price'], 0, ',', '.') }}</span>
                                </div>
                                <div class="col-md-2 text-right">
                                    <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="cart-total">
                        <p>Total: <span class="text-primary">Rp {{ number_format($totalPrice, 0, ',', '.') }}</span></p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ url('/menu') }}" class="btn btn-secondary">Lanjutkan Belanja</a>
                        <a href="{{ route('checkout.index') }}" class="btn btn-checkout">Checkout</a>
                    </div>
                </div>
            @else
                <div class="cart-empty">
                    <h3>Keranjang Anda kosong</h3>
                    <p>Silakan tambahkan beberapa item ke keranjang terlebih dahulu.</p>
                    <a href="{{ url('/menu') }}" class="btn btn-primary mt-3">Lihat Menu</a>
                </div>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Update quantity
            $('.update-cart').click(function(e) {
                e.preventDefault();

                let id = $(this).data('id');
                let inputElement = $(this).closest('.input-group').find('.quantity');
                let quantity = parseInt(inputElement.val());

                if ($(this).hasClass('decrease-quantity')) {
                    if (quantity > 1) {
                        quantity -= 1;
                    } else {
                        // Jika quantity 1 dan dikurangi lagi, hapus item
                        if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                            $.ajax({
                                url: '{{ route('cart.remove') }}',
                                method: 'DELETE',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    id: id
                                },
                                success: function(response) {
                                    window.location.reload();
                                }
                            });
                        }
                        return; // Hentikan eksekusi jika item dihapus
                    }
                } else if ($(this).hasClass('increase-quantity')) {
                    quantity += 1;
                }

                inputElement.val(quantity);

                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        quantity: quantity
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });

            // Remove item
            $('.remove-from-cart').click(function(e) {
                e.preventDefault();

                let id = $(this).data('id');

                if (confirm('Apakah Anda yakin ingin menghapus item ini?')) {
                    $.ajax({
                        url: '{{ route('cart.remove') }}',
                        method: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            });
        });
    </script>
@endsection
