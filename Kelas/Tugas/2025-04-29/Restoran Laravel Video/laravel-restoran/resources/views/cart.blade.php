@extends('layouts.front')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Keranjang Belanja</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('cart'))
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Menu</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach (session('cart') as $id => $details)
                                @php $total += $details['harga'] * $details['jumlah'] @endphp
                                <tr>
                                    <td>
                                        <img src="{{ asset('images/' . $details['gambar']) }}" alt="{{ $details['menu'] }}"
                                            class="img-thumbnail" width="100">
                                        <span class="ml-2">{{ $details['menu'] }}</span>
                                    </td>
                                    <td>Rp {{ number_format($details['harga'], 0, ',', '.') }}</td>
                                    <td>
                                        <input type="number" value="{{ $details['jumlah'] }}"
                                            class="form-control quantity update-cart" min="1" style="width: 70px;"
                                            data-id="{{ $id }}">
                                    </td>
                                    <td>Rp {{ number_format($details['harga'] * $details['jumlah'], 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-end"><strong>Total:</strong></td>
                                <td colspan="2"><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ url('/') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>Lanjut Belanja
                        </a>
                        <form action="{{ route('cart.checkout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success"
                                onclick="return confirm('Apakah Anda yakin ingin melakukan checkout?')">
                                Checkout<i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Keranjang belanja kosong</h4>
                <a href="{{ url('/') }}" class="btn btn-primary mt-3">Mulai Belanja</a>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".update-cart").change(function(e) {
                e.preventDefault();

                var ele = $(this);
                var quantity = ele.val();
                var id = ele.attr("data-id");

                $.ajax({
                    url: '{{ route('cart.update') }}',
                    method: "patch",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: id,
                        jumlah: quantity
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            });
        });
    </script>
@endsection
