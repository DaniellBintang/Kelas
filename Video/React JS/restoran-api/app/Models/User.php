<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class User extends Model
{
    use Authenticatable, Authorizable;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'password',
        'level',
        'api_token',
        'status',
        'relasi'
    ];

    protected $hidden = [
        'password',
        'api_token',
    ];
}
