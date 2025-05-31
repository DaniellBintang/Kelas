<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role = $request->input('role');
        
        // Query untuk user biasa
        $usersQuery = User::query();
        if ($search) {
            $usersQuery->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        $users = ($role && $role != 'user') ? collect([]) : $usersQuery->get();
        
        // Query untuk admin
        $adminsQuery = \App\Models\Admin::query();
        if ($search) {
            $adminsQuery->where(function($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                      ->orWhere('email', 'like', '%' . $search . '%');
            });
        }
        $admins = ($role && $role != 'admin') ? collect([]) : $adminsQuery->get();
        
        return view('admin.users.index', compact('users', 'admins'));
    }

    // ... existing code ...

    /**
     * Show the form for editing the specified admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editAdmin($id)
    {
        $admin = \App\Models\Admin::findOrFail($id);
        return view('admin.users.edit-admin', compact('admin'));
    }



    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $admin = new \App\Models\Admin();
        $admin->name = $validated['name'];
        $admin->email = $validated['email'];
        $admin->password = \Illuminate\Support\Facades\Hash::make($validated['password']);
        $admin->save();

        return redirect()->route('admin.users.index', ['role' => 'admin'])
            ->with('success', 'Admin baru berhasil ditambahkan!');
    }

    /**
     * Update the specified admin in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAdmin(Request $request, $id)
    {
        $admin = \App\Models\Admin::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $admin->name = $validated['name'];
        $admin->email = $validated['email'];

        if (!empty($validated['password'])) {
            $admin->password = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }

        $admin->save();

        return redirect()->route('admin.users.index', ['role' => 'admin'])
            ->with('success', 'Admin berhasil diperbarui!');
    }

    /**
     * Remove the specified admin from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyAdmin($id)
    {
        $admin = \App\Models\Admin::findOrFail($id);

        // Cek apakah ini adalah admin terakhir
        if (\App\Models\Admin::count() <= 1) {
            return redirect()->route('admin.users.index', ['role' => 'admin'])
                ->with('error', 'Tidak dapat menghapus admin terakhir!');
        }

        // Cek apakah ini adalah admin yang sedang login
        if (Auth::guard('admin')->id() == $id) {
            return redirect()->route('admin.users.index', ['role' => 'admin'])
                ->with('error', 'Tidak dapat menghapus akun admin yang sedang digunakan!');
        }

        $admin->delete();

        return redirect()->route('admin.users.index', ['role' => 'admin'])
            ->with('success', 'Admin berhasil dihapus!');
    }

    // ... existing code ...

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        $user->update($validated);

        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui');
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index')
            ->with('success', 'User berhasil dihapus');
    }
}
