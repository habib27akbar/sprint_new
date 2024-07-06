<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataMerek extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_merek', function (Blueprint $table) {
            $table->id();
            $table->string('id_permohonan', 4);
            $table->string('id_perusahaan', 25);
            $table->string('merek')->nullable();
            $table->string('illustrasi_merek')->nullable();
            $table->string('no_pendaftaran')->nullable();
            $table->date('tgl_pendaftaran')->nullable();
            $table->string('dokumen_pendaftaran_merek')->nullable();
            $table->string('no_permohonan_merek')->nullable();
            $table->date('tgl_penerimaan')->nullable();
            $table->date('tgl_dimulai_perlindungan')->nullable();
            $table->date('tgl_berakhir_perlindungan')->nullable();
            $table->string('sertifikat_merek')->nullable();
            $table->string('status_pemilik_merek')->nullable();
            $table->string('alamat')->nullable();
            $table->string('pelimpahan_merek')->nullable();
            $table->date('tgl_berakhir_pelimpahan_merek')->nullable();
            $table->string('dokumen_pelimpahan_merek')->nullable();
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
        Schema::dropIfExists('data_merek');
    }
}
