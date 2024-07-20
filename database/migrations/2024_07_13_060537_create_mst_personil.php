<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstPersonil extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_personil', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 200);
            $table->string('role', 50);
            $table->string('sts_penugasan', 20);
            $table->string('asal_sdm', 20);
            $table->string('sts_pegawai', 20);
            $table->string('sts_jabatan', 20);
            $table->string('sts_personil', 20);
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
        Schema::dropIfExists('mst_personil');
    }
}
