<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedomanSertifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedoman_sertifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('id_perusahaan', 25);
            $table->string('jenis_sistem_manajemen')->nullable();
            $table->string('versi_standar_sistem')->nullable();
            $table->string('lembaga_sertifikasi')->nullable();
            $table->string('nomor_sertifikat')->nullable();
            $table->string('masa_berlaku')->nullable();
            $table->string('logo_sertifikat')->nullable();
            $table->string('ruang_lingkup')->nullable();
            $table->string('penerapan')->nullable();
            $table->string('nama_konsultan')->nullable();
            $table->string('tahun_konsultan')->nullable();
            $table->string('sertifikat')->nullable();
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
        Schema::dropIfExists('pedoman_sertifikasi');
    }
}
