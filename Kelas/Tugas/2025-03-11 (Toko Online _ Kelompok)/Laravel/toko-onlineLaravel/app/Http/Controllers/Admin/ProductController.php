<?php
// app/Http/Controllers/Admin/ProductController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Generate unique filename
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '_' . time() . '.' . $extension;

            // Simpan file ke direktori public alih-alih storage
            $file->move(public_path('uploads'), $filename);

            // Create the product
            Product::create([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'stock' => $validated['stock'],
                'image' => $filename,
            ]);

            return redirect()->route('admin.products.index')
                ->with('success', 'Product added successfully!');
        }

        return redirect()->route('admin.products.index')
            ->with('error', 'Error adding product. Please try again.');
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $product = Product::findOrFail($id);
        $product->name = $validated['name'];
        $product->price = $validated['price'];
        $product->stock = $validated['stock'];

        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($product->image && file_exists(public_path('uploads/' . $product->image))) {
                unlink(public_path('uploads/' . $product->image));
            }

            // Generate unique filename
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = Str::uuid() . '_' . time() . '.' . $extension;

            // Simpan file ke direktori public alih-alih storage
            $file->move(public_path('uploads'), $filename);

            $product->image = $filename;
        }

        $product->save();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image if it exists
        if ($product->image && file_exists(public_path('uploads/' . $product->image))) {
            unlink(public_path('uploads/' . $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
