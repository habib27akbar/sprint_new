<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPerencanaan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_perencanaan', function (Blueprint $table) {
            $table->id();
            $table->string('id_perusahaan', 20);
            $table->string('no_proses', 20);
            $table->string('jml_auditor_kepala', 20)->nullable();
            $table->string('hari_kerja_auditor_kepala', 20)->nullable();
            $table->string('jumlah_perdiem_auditor_kepala', 20)->nullable();
            $table->string('jumlah_auditor', 20)->nullable();
            $table->string('hari_kerja_auditor', 20)->nullable();
            $table->string('hari_perdiem_auditor', 20)->nullable();
            $table->string('jumlah_mandays_auditor', 20)->nullable();
            $table->string('jumlah_tenaga_ahli', 20)->nullable();
            $table->string('jumlah_mandays_tenaga_ahli', 20)->nullable();
            $table->string('jumlah_observer', 20)->nullable();
            $table->string('jumlah_mandays_observer', 20)->nullable();
            $table->string('jumlah_ppc', 20)->nullable();
            $table->string('jumlah_mandays_ppc', 20)->nullable();
            $table->string('jumlah_perdiem', 20)->nullable();
            $table->string('jumlah_perdiem_personel', 20)->nullable();
            $table->string('jumlah_sni', 20)->nullable();
            $table->string('jumlah_sertifikat', 20)->nullable();
            $table->string('id_user', 20);
            $table->string('id_user_update', 20)->nullable();
            $table->string('status_perencanaan', 20)->nullable();
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
        Schema::dropIfExists('t_perencanaan');
    }
}
