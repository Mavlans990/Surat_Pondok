<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'tb_produk';
    protected $primaryKey = 'produk_id';
    protected $fillable = ['produk_kode', 'produk_nama', 'produk_hrg', 'produk_keterangan', 'produk_stock', 'kat_id'];

    public function kategori_relasi(){
        return $this->belongsTo(Kategori::class, 'kat_id');
    }

    public function order_detail(){
        return $this->hasMany(OrderDetail::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
