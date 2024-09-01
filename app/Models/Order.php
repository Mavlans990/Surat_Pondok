<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'tb_order';
    protected $primaryKey = 'order_id';
    protected $fillable = ['order_tgl', 'order_kode', 'order_ttl', 'order_kurir', 'order_ongkir', 'order_byr_deadline', 'order_batal', 'user_id'];

    public function produk_relasi(){
        return $this->belongsTo(Produk::class, 'produk_id');
    }

    public function order_detail(){
        return $this->hasMany(OrderDetail::class);
    }
}
