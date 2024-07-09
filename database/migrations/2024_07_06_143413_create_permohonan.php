<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermohonan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permohonan', function (Blueprint $table) {
            $table->id();
            $table->string('id_perusahaan', 25);
            $table->string('surat_permohonan')->nullable();
            $table->string('formulir_pendaftaran')->nullable();
            $table->string('no_surat_permohonan');
            $table->date('tgl_surat_permohonan');
            $table->string('no_order', 50)->nullable();
            $table->string('no_proses', 50)->nullable();
            $table->string('menu', 50);
            $table->string('tujuan_audit', 50);
            $table->string('proses_lain', 50);
            $table->string('no_sertifikat_referensi', 50);
            $table->date('masa_berlaku');
            $table->date('masa_berlaku_akhir');
            $table->string('id_standar', 2);
            $table->string('status_komoditi');
            $table->string('illustrasi_penandaan_standar')->nullable();
            $table->string('status_penerapan_smm')->nullable();
            $table->string('akreditasi_lssm')->nullable();
            $table->string('keterangan')->nullable();
            $table->date('tanggal_terima')->nullable();
            $table->date('tanggal_input')->nullable();
            $table->date('tanggal_order')->nullable();
            $table->string('sts_permohonan', 100);
            $table->string('sts', 1);
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
        Schema::dropIfExists('permohonan');
    }
}
