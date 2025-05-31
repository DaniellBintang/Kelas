<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = 'order_details';
    protected $primaryKey = 'idorderdetail';
    public $timestamps = false;
    protected $fillable = ['idorder', 'idmenu', 'jumlah', 'harga'];

    public function order()
    {
        return $this->belongsTo(Order::class, 'idorder', 'idorder');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'idmenu', 'idmenu');
    }
}
