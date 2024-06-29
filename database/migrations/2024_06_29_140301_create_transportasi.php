<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transportasi', function (Blueprint $table) {
            $table->id();
            $table->string('id_perusahaan', 25);
            $table->string('asal')->nullable();
            $table->string('tujuan')->nullable();
            $table->string('rute')->nullable();
            $table->string('moda')->nullable();
            $table->string('jarak_tempuh')->nullable();
            $table->string('waktu')->nullable();
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
        Schema::dropIfExists('transportasi');
    }
}
