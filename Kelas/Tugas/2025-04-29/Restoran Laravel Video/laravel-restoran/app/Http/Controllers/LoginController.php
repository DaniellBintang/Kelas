<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Kategori;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('login', compact('kategoris'));
    }

    public function postlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $pelanggan = Pelanggan::where('email', $request->email)->first();

        if ($pelanggan && $pelanggan->password === $request->password) {
            $request->session()->put('idpelanggan', [
                'id' => $pelanggan->idpelanggan,
                'email' => $pelanggan->email,
                'nama' => $pelanggan->nama
            ]);
            return redirect('/');
        }

        return redirect('login')->with('pesan', 'Email atau password salah!');
    }

    public function logout()
    {
        session()->forget('idpelanggan');
        return redirect('/');
    }
}
