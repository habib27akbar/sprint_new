<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerjanjianSertifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perjanjian_sertifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('id_perusahaan', 25);
            $table->string('jenis_sertifikasi')->nullable();
            $table->string('perjanjian_sertifikasi_klien')->nullable();
            $table->string('perjanjian_sertifikasi_user')->nullable();
            $table->string('nomor')->nullable();
            $table->date('tanggal_berlaku')->nullable();
            $table->date('tanggal_berakhir')->nullable();
            $table->string('status', 20);
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
        Schema::dropIfExists('perjanjian_sertifikasi');
    }
}
