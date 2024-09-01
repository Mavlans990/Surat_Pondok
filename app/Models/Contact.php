<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Contact extends Model
{
    use HasFactory;

    protected $table = 'tb_contact';
    protected $primaryKey = 'id';
    protected $fillable = ['firstname', 'lastname', 'email', 'phone', 'users_id'];

    public function user_relasi(){
        return $this->belongsTo(Users::class, 'users_id');
    }

    public function address_relasi(){
        return $this->hasMany(Address::class);
    }
}
