<?php
// app/Http/Controllers/Admin/RatingController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;

class RatingAdminController extends Controller
{
    /**
     * Display a listing of the ratings.
     */
    public function index(Request $request)
    {
        // Get filter parameters
        $productFilter = $request->input('product');
        $ratingFilter = $request->input('rating');

        // Build the query with filters
        $query = Rating::with(['product', 'user'])
            ->orderBy('created_at', 'desc');

        if (!empty($productFilter)) {
            $query->whereHas('product', function ($q) use ($productFilter) {
                $q->where('name', 'like', "%{$productFilter}%");
            });
        }

        if (!empty($ratingFilter)) {
            $query->where('rating', $ratingFilter);
        }

        // Execute the query
        $ratings = $query->get();

        // Get list of products for dropdown
        $products = Product::orderBy('name')->get();

        return view('admin.ratings.index', compact('ratings', 'products', 'productFilter', 'ratingFilter'));
    }

    /**
     * Remove the specified rating.
     */
    public function destroy($id)
    {
        try {
            $rating = Rating::findOrFail($id);
            $rating->delete();
            return redirect()->route('admin.ratings.index')
                ->with('success', 'Rating successfully deleted');
        } catch (\Exception $e) {
            return redirect()->route('admin.ratings.index')
                ->with('error', 'Error deleting rating: ' . $e->getMessage());
        }
    }
}
