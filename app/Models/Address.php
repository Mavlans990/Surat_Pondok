<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Address extends Model
{
    use HasFactory;

    // protected $guarded = ['id'];

    protected $table = 'tb_address';
    protected $primaryKey = 'id';
    protected $fillable = ['street', 'city', 'province', 'country', 'postal_code', 'tb_contact_id'];

    public function contact_relasi(){
        return $this->belongsTo(Contact::class, 'tb_contact_id');
    }
}
