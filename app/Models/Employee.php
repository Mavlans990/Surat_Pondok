<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'tb_employee';
    protected $primaryKey = 'employee_id';
    protected $fillable = ['employee_name', 'employee_password', 'employee_role', 'employee_role_2', 'employee_kode'];
}
