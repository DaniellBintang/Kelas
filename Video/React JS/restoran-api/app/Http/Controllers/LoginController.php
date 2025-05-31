<?php

namespace App\Http\Controllers;

use App\Models\User;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends BaseController
{
    public function index()
    {
        $data = User::where('level', '<>', 'pelanggan')->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil ditemukan',
            'data' => $data
        ], 200);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            if ($user->status == 1) {
                // Generate new random api_token
                $user->api_token = rand(100000, 99999999);
                $user->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Login berhasil',
                    'api_token' => $user->api_token,
                    'user' => $user
                ], 200);
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Akun ini diBanned'
                ], 401);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau password salah'
            ], 401);
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->status = $request->input('status');
            $user->save();
            return response()->json(['message' => 'Status berhasil diubah']);
        } else {
            return response()->json(['message' => 'User tidak ditemukan'], 404);
        }
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'level'   => 'required',
        ]);

        $user = User::create([
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'level'    => $request->level,
            'api_token' => rand(100000, 99999999),
            'status'   => 1,
            'relasi'   => 'Back'
        ]);

        return response()->json([
            'message' => 'Registrasi berhasil',
            'user'    => $user
        ], 201);
    }
}
