<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = DB::table('menus')
            ->join('kategori', 'kategori.idkategori', '=', 'menus.idkategori') // Ganti 'menu' menjadi 'menus'
            ->select('menus.*', 'kategori.kategori')
            ->orderBy('menus.menu', 'asc')
            ->get();

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->validate($request, [
            'idkategori' => 'required|integer',
            'menu' => 'required|string',
            'harga' => 'required|integer',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(base_path('public/uploads'), $filename);
            $gambarPath = 'uploads/' . $filename;
            $gambarUrl = url($gambarPath); // Tambahkan URL lengkap

            // Simpan data menu ke database
            $menu = Menu::create([
                'idkategori' => $request->idkategori,
                'menu' => $request->menu,
                'gambar' => $gambarUrl, // Simpan URL lengkap ke database
                'harga' => $request->harga
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Menu berhasil ditambahkan',
                'data' => $menu,
                'kategori' => [
                    'idkategori' => $request->idkategori,
                    'kategori' => DB::table('kategori')->where('idkategori', $request->idkategori)->value('kategori'),
                    'keterangan' => DB::table('kategori')->where('idkategori', $request->idkategori)->value('keterangan'),
                ]
            ], 201);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada file gambar yang diupload'
            ], 400);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('menus')
            ->join('kategori', 'kategori.idkategori', '=', 'menus.idkategori')
            ->select('menus.*', 'kategori.kategori')
            ->where('menus.idmenu', $id)
            ->first();

        if ($data) {
            return response()->json($data);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::where('idmenu', $id)->first();
        if (!$menu) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Validasi input
        $this->validate($request, [
            'idkategori' => 'required|integer',
            'menu' => 'required|string',
            'harga' => 'required|integer',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $menu->idkategori = $request->idkategori;
        $menu->menu = $request->menu;
        $menu->harga = $request->harga;

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(base_path('public/uploads'), $filename);
            $menu->gambar = url('uploads/' . $filename);
        }

        $menu->save();

        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => $menu
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::where('idmenu', $id)->first();
        if ($menu) {
            $menu->delete();
            return response()->json(['message' => 'Data berhasil dihapus']);
        } else {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
    }
}
