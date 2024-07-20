<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMstPejabat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mst_pejabat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pejabat', 50);
            $table->string('jabatan', 100);
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
        Schema::dropIfExists('mst_pejabat');
    }
}
