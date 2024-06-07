<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlienAktaPendirian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klien_akta_pendirian', function (Blueprint $table) {
            $table->id();
            $table->integer('id_klien');
            $table->text('salinan_akta_pendirian_perusahaan')->nullable();
            $table->text('salinan_akta_pendirian_perusahaan_tersumpah')->nullable();
            $table->string('nama_notaris')->nullable();
            $table->string('kedudukan_notaris')->nullable();
            $table->date('tanggal')->nullable();
            $table->string('nomor_akta')->nullable();
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
        Schema::dropIfExists('klien_akta_pendirian');
    }
}
