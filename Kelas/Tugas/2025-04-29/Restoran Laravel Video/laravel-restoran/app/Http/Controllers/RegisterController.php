<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('register', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
            'email' => 'required|email|unique:pelanggans,email',
            'password' => 'required|min:6'
        ]);

        try {
            $pelanggan = Pelanggan::create([
                'nama' => $request->pelanggan,
                'alamat' => $request->alamat,
                'telp' => $request->telp,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            if ($pelanggan) {
                return redirect('login')->with('success', 'Registrasi berhasil! Silahkan login.');
            }
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat mendaftar. Silahkan coba lagi.');
        }
    }
}
