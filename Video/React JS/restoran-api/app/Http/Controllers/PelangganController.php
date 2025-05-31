<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pelanggan::all();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required'
        ]);

        $data = $request->only(['nama', 'alamat', 'telp']);
        $pelanggan = Pelanggan::create($data);

        if ($pelanggan) {
            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $pelanggan
            ], 201);
        } else {
            return response()->json(['message' => 'Gagal menambahkan data'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->only(['nama', 'alamat', 'telp']);
        $pelanggan = Pelanggan::create($data);
        return response()->json($pelanggan, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelanggan = Pelanggan::where('idpelanggan', $id)->first();
        if ($pelanggan) {
            return response()->json($pelanggan);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::where('idpelanggan', $id)->first();
        if (!$pelanggan) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Validasi input
        $this->validate($request, [
            'nama' => 'required',
            'alamat' => 'required',
            'telp' => 'required'
        ]);

        $pelanggan->nama = $request->nama;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->telp = $request->telp;
        $pelanggan->save();

        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => $pelanggan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::where('idpelanggan', $id)->first();
        if ($pelanggan) {
            $pelanggan->delete();
            return response()->json(['message' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
