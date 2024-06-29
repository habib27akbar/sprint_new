<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKbli extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kbli', function (Blueprint $table) {
            $table->id();
            $table->string('id_perusahaan', 25);
            $table->string('kode_kbli')->nullable();
            $table->string('nama_kbli')->nullable();
            $table->string('lokasi_usaha')->nullable();
            $table->string('tipe', 1)->nullable();
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
        Schema::dropIfExists('kbli');
    }
}
