<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'idorder';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'idpelanggan',
        'tglorder',
        'total',
        'bayar',
        'kembali',
        'status',
    ];

    // Kalau mau relasi (misal ke Pelanggan)
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'idpelanggan', 'idpelanggan');
    }
}
