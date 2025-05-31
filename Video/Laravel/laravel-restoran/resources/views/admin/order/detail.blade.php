@extends('backend.back')

@section('admincontent')
    <div>
        <h2>Order Detail</h2>
    </div>
    <div>
        <h2>Pelanggan : {{ $orders[0]['pelanggan'] }}</h2>
        <h2>Total : {{ number_format($orders[0]['total']) }}</h2>
    </div>
    <div>
        <a href="{{ url('admin/kategori/create') }}" class="btn btn-primary">Tambah Data</a>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Menu</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            @php
                $no = 1;
            @endphp
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $order->menu }}</td>
                        <td>{{ $order->harga }}</td>
                        <td>{{ $order->jumlah }}</td>
                        <td>0</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
