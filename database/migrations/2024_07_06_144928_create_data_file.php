<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataFile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_file', function (Blueprint $table) {
            $table->id();
            $table->string('id_permohonan', 4);
            $table->string('id_perusahaan', 25);
            $table->string('nama_file')->nullable();
            $table->string('file')->nullable();
            $table->string('tipe', 1);
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
        Schema::dropIfExists('data_file');
    }
}
