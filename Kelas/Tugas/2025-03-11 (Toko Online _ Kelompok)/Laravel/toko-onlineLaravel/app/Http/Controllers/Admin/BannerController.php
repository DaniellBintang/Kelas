<?php
// app/Http/Controllers/Admin/BannerController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the banners.
     */
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));
    }

    /**
     * Store a newly created banner in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:static,dynamic',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        // Mengubah dari storeAs ke move untuk simpan langsung ke direktori public
        $request->image->move(public_path('images'), $imageName);

        Banner::create([
            'image' => $imageName,
            'type' => $request->type,
        ]);

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner successfully added!');
    }

    /**
     * Update the specified banner in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'type' => 'required|in:static,dynamic',
        ]);

        $banner = Banner::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old image from public directory
            if (file_exists(public_path('images/' . $banner->image))) {
                unlink(public_path('images/' . $banner->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $banner->image = $imageName;
        }

        $banner->type = $request->type;
        $banner->save();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner successfully updated!');
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);

        // Delete image file from public directory
        if (file_exists(public_path('images/' . $banner->image))) {
            unlink(public_path('images/' . $banner->image));
        }

        $banner->delete();

        return redirect()->route('admin.banners.index')
            ->with('success', 'Banner successfully deleted!');
    }
}
