<?php
// app/Models/User.php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    // Disable the updated_at timestamp
    const UPDATED_AT = null;

    protected $fillable = [
        'full_name',
        'email',
        'password',
        'address',
        'city',
        'postal_code',
        'phone',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    // Check if user is admin
    public function isAdmin()
    {
        return $this->is_admin;
    }
}
