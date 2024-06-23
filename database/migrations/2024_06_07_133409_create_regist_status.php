<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regist_status', function (Blueprint $table) {
            $table->id();
            $table->string('id_pelanggan');
            $table->dateTime('tanggal_pengajuan');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('regist_status');
    }
}
