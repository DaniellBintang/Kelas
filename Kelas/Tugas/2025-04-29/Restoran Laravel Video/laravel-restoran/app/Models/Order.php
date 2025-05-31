<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'idorder';
    public $timestamps = false;
    protected $fillable = ['idpelanggan', 'tglorder', 'total', 'status'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'idpelanggan', 'idpelanggan');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'idorder', 'idorder');
    }
}
