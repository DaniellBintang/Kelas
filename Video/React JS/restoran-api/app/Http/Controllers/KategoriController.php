<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $data = Kategori::all();
        return response()->json($data);
    }

    public function create(Request $request)
    {
        // Validasi input
        $this->validate($request, [
            'kategori' => 'required',
            'keterangan' => 'required'
        ]);

        // Cek apakah data dengan kategori dan keterangan yang sama sudah ada
        $exists = Kategori::where('kategori', $request->kategori)
            ->where('keterangan', $request->keterangan)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Data sudah dimasukkan'
            ], 409);
        }

        $data = $request->only(['kategori', 'keterangan']);
        $kategori = Kategori::create($data);

        if ($kategori) {
            return response()->json([
                'message' => 'Data berhasil ditambahkan',
                'data' => $kategori
            ], 201);
        } else {
            return response()->json(['message' => 'Gagal menambahkan data'], 500);
        }
    }


    public function show($id)
    {
        $kategori = Kategori::where('idkategori', $id)->first();
        if ($kategori) {
            return response()->json($kategori);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $kategori = Kategori::where('idkategori', $id)->first();
        if (!$kategori) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Validasi input
        $this->validate($request, [
            'kategori' => 'required',
            'keterangan' => 'required'
        ]);

        $kategori->kategori = $request->kategori;
        $kategori->keterangan = $request->keterangan;
        $kategori->save();

        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => $kategori
        ]);
    }

    public function destroy($id)
    {
        $kategori = Kategori::where('idkategori', $id)->first();
        if ($kategori) {
            $kategori->delete();
            return response()->json(['message' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
