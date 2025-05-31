<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */ public function index()
    {
        $orders = Order::join('pelanggans', 'orders.idpelanggan', '=', 'pelanggans.idpelanggan')
            ->select('orders.*', 'pelanggans.nama as nama_pelanggan', 'pelanggans.alamat as alamat_pelanggan')
            ->get();

        return response()->json($orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($tgl_awal, $tgl_akhir)
    {
        $orders = Order::join('pelanggans', 'orders.idpelanggan', '=', 'pelanggans.idpelanggan')
            ->whereBetween('tglorder', [$tgl_awal, $tgl_akhir])
            ->select('orders.*', 'pelanggans.nama as nama_pelanggan', 'pelanggans.alamat as alamat_pelanggan')
            ->get();

        if ($orders->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Data berhasil ditemukan', 'data' => $orders]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'bayar' => 'required|integer',
            'kembali' => 'required|integer',
            'status' => 'required|in:Lunas,Belum Bayar',
        ]);

        $data = [
            'bayar' => $request->input('bayar'),
            'kembali' => $request->input('kembali'),
            'status' => $request->input('status'),
        ];

        $order = Order::where('idorder', $id)->update($data);
        if ($order) {
            return response()->json(['message' => 'Order updated successfully']);
        } else {
            return response()->json(['message' => 'Order not found'], 404);
        }
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy($idorder)
    {
        $order = Order::where('idorder', $idorder)->first();

        if (!$order) {
            return response()->json(['pesan' => 'Data tidak ditemukan'], 404);
        }

        $order->delete();

        return response()->json(['pesan' => 'Data berhasil dihapus']);
    }
}
