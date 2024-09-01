<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'tb_order_detail';
    protected $primaryKey = 'order_detail_id';
    protected $fillable = ['order_kode', 'produk_kode', 'detail_harga', 'detail_jml'];

    public function order_relasi(){
        return $this->belongsTo(Order::class, 'order_kode');
    }

    // public function produk_relasi(){
    //     return $this->belongsTo(Produk::class, 'produk_kode');
    // }
}
