<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    /**
     * Display a listing of all product ratings.
     */
    public function index()
    {
        // Get all products with their average ratings
        $products = Product::select(
            'products.id',
            'products.name',
            'products.image',
            DB::raw('COUNT(ratings.id) as review_count'),
            DB::raw('AVG(ratings.rating) as avg_rating')
        )
            ->leftJoin('ratings', 'products.id', '=', 'ratings.product_id')
            ->groupBy('products.id', 'products.name', 'products.image')
            ->get();

        // Get cart quantity for the badge
        $cartTotalQuantity = $this->getCartTotalQuantity();

        return view('ratings.index', compact('products', 'cartTotalQuantity'));
    }

    /**
     * Display a specific product with its ratings.
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        // Get product ratings with user information
        $ratings = Rating::where('product_id', $id)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate average rating
        $averageRating = $ratings->avg('rating') ?? 0;

        // Get rating counts by star
        $ratingCounts = [
            5 => $ratings->where('rating', 5)->count(),
            4 => $ratings->where('rating', 4)->count(),
            3 => $ratings->where('rating', 3)->count(),
            2 => $ratings->where('rating', 2)->count(),
            1 => $ratings->where('rating', 1)->count()
        ];

        // Get cart quantity for the badge
        $cartTotalQuantity = $this->getCartTotalQuantity();

        return view('ratings.show', compact(
            'product',
            'ratings',
            'averageRating',
            'ratingCounts',
            'cartTotalQuantity'
        ));
    }

    /**
     * Helper method to get star rating HTML.
     */
    public static function getStarRating($rating)
    {
        $fullStar = '<i class="fas fa-star"></i>';
        $halfStar = '<i class="fas fa-star-half-alt"></i>';
        $emptyStar = '<i class="far fa-star"></i>';

        $output = '';
        $whole = floor($rating);
        $fraction = $rating - $whole;

        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $whole) {
                $output .= $fullStar;
            } elseif ($i == $whole + 1 && $fraction >= 0.5) {
                $output .= $halfStar;
            } else {
                $output .= $emptyStar;
            }
        }

        return $output;
    }

    /**
     * Get total quantity of items in cart.
     */
    private function getCartTotalQuantity()
    {
        $cart = Session::get('cart', []);
        return array_sum($cart);
    }
}
