<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstSertifikat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_sertifikat', function (Blueprint $table) {
            $table->id();
            $table->string('id_perusahaan', 25);
            $table->string('no_sertifikat')->nullable();
            $table->string('menu', 100)->nullable();
            $table->string('id_ruang_lingkup', 20)->nullable();
            $table->string('dua_digit')->nullable();
            $table->string('sub_kelompok')->nullable();
            $table->string('nace')->nullable();
            $table->string('lingkup')->nullable();
            $table->string('penerapan_sni')->nullable();
            $table->string('tersertifikasi_sejak')->nullable();
            $table->string('tanggal_terbit')->nullable();
            $table->string('tanggal_berakhir')->nullable();
            $table->string('merek')->nullable();
            $table->string('tipe')->nullable();
            $table->string('status_sertifikat')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('id_user', 20);
            $table->string('id_user_update', 20)->nullable();
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
        Schema::dropIfExists('mst_sertifikat');
    }
}
