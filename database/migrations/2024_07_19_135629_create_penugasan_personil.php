<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenugasanPersonil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penugasan_personil', function (Blueprint $table) {
            $table->id();
            $table->string('id_perusahaan', 20);
            $table->string('id_personil', 4);
            $table->string('pemeriksaan_kelengkapan_kebenaran_dokumen', 100);
            $table->string('pemeriksaan_kebenaran_persyaratan', 100);
            $table->string('kajian_permohonan', 100);
            $table->string('audit', 100);
            $table->string('no_disposisi', 100);
            $table->date('tgl_disposisi');
            $table->string('id_pejabat', 4);
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
        Schema::dropIfExists('penugasan_personil');
    }
}
