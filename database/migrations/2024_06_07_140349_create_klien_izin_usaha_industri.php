<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKlienIzinUsahaIndustri extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('klien_izin_usaha_industri', function (Blueprint $table) {
            $table->id();
            $table->integer('id_klien');
            $table->text('salinan_izin_industri')->nullable();
            $table->text('salinan_izin_industri_tersumpah')->nullable();
            $table->string('NIB');
            $table->string('instansi_penerbit');
            $table->string('jenis_angka_pengenal_importir');
            $table->string('status_penanaman_modal');
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
        Schema::dropIfExists('klien_izin_usaha_industri');
    }
}
