<?php
// app/Models/CustomerAddress.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $fillable = [
        'user_id',
        'address',
        'city',
        'postal_code',
        'is_default',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
