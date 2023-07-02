<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_reservasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tgl_reservasi');
            $table->string('nm_costumer', 40);
            $table->string('kd_kamar', 15);
            $table->integer('jumlah');
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
        Schema::dropIfExists('tbl_reservasi');
    }
};
