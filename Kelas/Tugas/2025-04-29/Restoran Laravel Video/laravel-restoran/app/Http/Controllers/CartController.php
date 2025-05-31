<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all(); // Tambahkan ini
        return view('cart', compact('kategoris')); // Modifikasi ini
    }

    public function addToCart($id)
    {
        if (!session()->has('idpelanggan')) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu untuk melakukan pemesanan');
        }

        $menu = Menu::find($id);

        if (!$menu) {
            return redirect()->back()->with('error', 'Menu tidak ditemukan');
        }
        $cart = session()->get('cart', []);

        // Jika item sudah ada di cart, tambah jumlahnya
        if (isset($cart[$id])) {
            $cart[$id]['jumlah']++;
        } else {
            // Jika item belum ada di cart, tambahkan dengan jumlah 1
            $cart[$id] = [
                "idmenu" => $menu->idmenu,
                "menu" => $menu->menu,
                "jumlah" => 1,
                "harga" => $menu->harga,
                "gambar" => $menu->gambar
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan ke keranjang!');
    }

    public function updateCart(Request $request)
    {
        if ($request->id && $request->jumlah) {
            $cart = session()->get('cart');
            $cart[$request->id]["jumlah"] = $request->jumlah;
            session()->put('cart', $cart);

            return response()->json(['success' => true]);
        }
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back();
    }

    public function checkout()
    {
        if (!session()->has('idpelanggan')) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu');
        }

        if (!session()->has('cart') || empty(session('cart'))) {
            return redirect()->back()
                ->with('error', 'Keranjang belanja kosong');
        }

        try {
            $cart = session('cart');
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['harga'] * $item['jumlah'];
            }

            // Buat order baru
            $order = Order::create([
                'idpelanggan' => session('idpelanggan')['id'],
                'tglorder' => now(),
                'total' => $total,
                'status' => 0, // 0 = pending, 1 = confirmed, 2 = completed
            ]);

            // Masukkan detail order
            foreach ($cart as $item) {
                OrderDetail::create([
                    'idorder' => $order->idorder,
                    'idmenu' => $item['idmenu'],
                    'jumlah' => $item['jumlah'],
                    'harga' => $item['harga']
                ]);
            }

            // Kosongkan cart
            session()->forget('cart');

            return redirect()->route('order.success', $order->idorder)
                ->with('success', 'Pesanan berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Terjadi kesalahan saat checkout. Silakan coba lagi.');
        }
    }


    public function orderSuccess($id)
    {
        $order = Order::with(['orderDetails.menu', 'pelanggan'])
            ->where('idorder', $id)
            ->where('idpelanggan', session('idpelanggan')['id'])
            ->firstOrFail();

        // Ubah view path dari 'order-success' menjadi 'order.success'
        return view('order.success', [
            'order' => $order,
            'kategoris' => Kategori::all()
        ]);
    }
}
