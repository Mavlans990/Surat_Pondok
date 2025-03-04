<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TbEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_employee', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('employee_kode');
            $table->string('employee_name')->nullable();
            $table->string('employee_password');
            $table->string('employee_role');
            $table->string('employee_role_2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_employee');
    }
}
