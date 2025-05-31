<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('details')
            ->join('orders', 'details.idorder', '=', 'orders.idorder')
            ->join('menus', 'menus.idmenu', '=', 'details.idmenu')
            ->join('pelanggans', 'pelanggans.idpelanggan', '=', 'orders.idpelanggan')
            ->join('kategori', 'kategori.idkategori', '=', 'menus.idkategori')
            ->select(
                'orders.idorder',
                'orders.tglorder',
                'orders.total',
                'orders.bayar',
                'orders.kembali',
                'orders.status',
                'pelanggans.nama as nama_pelanggan',
                'pelanggans.alamat as alamat_pelanggan',
                'menus.menu as nama_menu',
                'menus.harga',
                'details.jumlah',
                'kategori.kategori as kategori_menu',
                DB::raw('details.jumlah * menus.harga as subtotal')
            )
            ->orderBy('orders.idorder', 'desc')
            ->get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'Tidak ada data detail ditemukan'], 404);
        }

        return response()->json(['message' => 'Data detail berhasil ditemukan', 'data' => $data]);
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
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function show($tgl_awal, $tgl_akhir)
    {
        $data = DB::table('details')
            ->join('orders', 'details.idorder', '=', 'orders.idorder')
            ->join('menus', 'menus.idmenu', '=', 'details.idmenu')
            ->join('pelanggans', 'pelanggans.idpelanggan', '=', 'orders.idpelanggan')
            ->join('kategori', 'kategori.idkategori', '=', 'menus.idkategori')
            ->whereBetween('orders.tglorder', [$tgl_awal, $tgl_akhir])
            ->select(
                'orders.idorder',
                'orders.tglorder',
                'orders.total',
                'orders.bayar',
                'orders.kembali',
                'orders.status',
                'pelanggans.nama as nama_pelanggan',
                'pelanggans.alamat as alamat_pelanggan',
                'menus.menu as nama_menu',
                'menus.harga',
                'details.jumlah',
                'kategori.kategori as kategori_menu',
                DB::raw('details.jumlah * menus.harga as subtotal')
            )
            ->orderBy('orders.status', 'asc')
            ->get();

        if ($data->isEmpty()) {
            return response()->json(['message' => 'Detail order tidak ditemukan'], 404);
        }

        return response()->json(['message' => 'Data detail berhasil ditemukan', 'data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function edit(Detail $detail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Detail $detail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Detail  $detail
     * @return \Illuminate\Http\Response
     */
    public function destroy(Detail $detail)
    {
        //
    }
}
