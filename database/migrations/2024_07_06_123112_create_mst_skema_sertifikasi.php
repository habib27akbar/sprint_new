<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstSkemaSertifikasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_skema_sertifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('kode_skema_sertifikasi');
            $table->string('nama_skema_sertifikasi');
            $table->string('kode_no_order', 5);
            $table->string('order')->nullable();
            $table->string('status', 20)->nullable();
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
        Schema::dropIfExists('mst_skema_sertifikasi');
    }
}
