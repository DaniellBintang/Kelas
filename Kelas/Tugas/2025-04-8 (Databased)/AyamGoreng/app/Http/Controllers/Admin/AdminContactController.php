<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    /**
     * Tampilkan daftar kontak.
     */
    public function index(Request $request)
    {
        $query = Contact::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%")
                    ->orWhere('message', 'LIKE', "%{$search}%");
            });
        }

        // Sort by latest by default
        $query->latest();

        $contacts = $query->paginate(10)->withQueryString();

        return view('admin.contacts.index', compact('contacts'));
    }

    /**
     * Hapus kontak dari database.
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
