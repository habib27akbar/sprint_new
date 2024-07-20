<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTPermohonanDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('t_permohonan_detail', function (Blueprint $table) {
            $table->id();
            $table->string('id_tinjauan', 20);
            $table->string('id_permohonan', 20);
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
        Schema::dropIfExists('t_permohonan_detail');
    }
}
