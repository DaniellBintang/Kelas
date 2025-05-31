<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Menu;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        // Pastikan admin sudah login
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        // Hitung jumlah data dari database
        $userCount = User::count();
        $menuCount = Menu::count();
        $orderCount = Order::count();
        
        // Pastikan kita menghitung jumlah kontak dengan benar
        $contactCount = Contact::count();
        
        // Pastikan variabel contactCount diteruskan ke view
        return view('admin.dashboard', compact('menuCount', 'orderCount', 'userCount', 'contactCount'));
    }
}
