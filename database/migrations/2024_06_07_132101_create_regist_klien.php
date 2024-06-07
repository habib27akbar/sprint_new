<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistKlien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regist_klien', function (Blueprint $table) {
            $table->id();
            $table->string('id_perusahaan', 25);
            $table->string('jenis_badan_usaha', 10);
            $table->string('nama_perusahaan', 100);
            $table->string('jenis_produsen', 20);
            $table->string('nama', 150);
            $table->string('posisi', 100);
            $table->string('perusahaan', 30);
            $table->string('email', 200);
            $table->string('username', 10);
            $table->string('password');
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
        Schema::dropIfExists('regist_klien');
    }
}
