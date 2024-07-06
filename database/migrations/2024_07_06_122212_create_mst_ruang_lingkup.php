<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstRuangLingkup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_ruang_lingkup', function (Blueprint $table) {
            $table->id();
            $table->string('id_skema', 5)->nullable();
            $table->string('id_kategori', 5)->nullable();
            $table->string('id_sub_kategori', 5)->nullable();
            $table->string('nomor_standar');
            $table->string('judul_standar');
            $table->string('id_produk', 5)->nullable();
            $table->string('tipe_sertifikasi')->nullable();
            $table->string('jenis_sertifikasi')->nullable();
            $table->string('lab')->nullable();
            $table->string('status_regulasi')->nullable();
            $table->string('ruang_lingkup')->nullable();
            $table->string('kode_iaf')->nullable();
            $table->string('penjabaran_iaf')->nullable();
            $table->string('id_user', 20);
            $table->string('id_user_update', 20)->nullable();
            $table->string('status', 20)->nullable();
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
        Schema::dropIfExists('mst_ruang_lingkup');
    }
}
