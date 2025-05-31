@extends('backend.back')

@section('admincontent')
    <div>
        <h2>Order</h2>
    </div>
    <div>
        <a href="{{ url('admin/kategori/create') }}" class="btn btn-primary">Tambah Data</a>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pelanggan</th>
                    <th>Tanggal</th>
                    <th>Total</th>
                    <th>Bayar</th>
                    <th>Kembali</th>
                    <th>Status</th>
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td><a href="{{ url('admin/order/' . $order->idorder . '/edit') }}">{{ $order->pelanggan }}</a></td>
                        <td>{{ $order->tglorder }}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->bayar }}</td>
                        <td>{{ $order->kembali }}</td>
                        @php
                            $status = 'Lunas';
                            if ($order->status == 0) {
                                $status = '<a href=" ' . url('admin/order/' . $order->idorder) . ' ">Bayar</a>';
                            }
                        @endphp
                        <td>{!! $status !!}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center mt-5">
        {{ $orders->withQueryString()->links() }}
    </div>
@endsection
