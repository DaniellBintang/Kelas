<?php
// app/Models/Order.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Add these lines to disable the updated_at timestamp
    const UPDATED_AT = null;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
        'shipping_address',
        'shipping_city',
        'shipping_postal_code',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
