<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $table = 'tb_surat';
    protected $primaryKey = 'surat_id';
    protected $fillable = ['surat_judul', 'surat_tgl_upload', 'surat_kode', 'surat_pdf', 'surat_qr_code', 'surat_link'];
}
