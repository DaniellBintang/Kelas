<?php
// app/Http/Controllers/Admin/DashboardController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use App\Models\Rating;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        // We'll add these stats later when implementing the full functionality
        $stats = [
            'products' => Product::count(),
            'orders' => Order::count(),
            'users' => User::count(),
            'ratings' => Rating::count(),
            'contacts' => ContactMessage::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
