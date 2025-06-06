<?php
// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'stock',
    ];

    // Relationships
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Get average rating attribute
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?: 0;
    }
}
