<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstPengguna extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_pengguna', function (Blueprint $table) {
            $table->id();
            $table->integer('id_unit_kerja');
            $table->string('kode_pengguna');
            $table->string('password');
            $table->string('nama_pengguna');
            $table->string('email')->nullable();
            $table->string('id_perusahaan')->nullable();
            $table->string('nip')->nullable();
            $table->string('nomor_handphone')->nullable();
            $table->integer('status');
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
        Schema::dropIfExists('mst_pengguna');
    }
}
