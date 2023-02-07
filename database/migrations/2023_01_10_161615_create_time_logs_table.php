<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horas_registradas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->datetime('hora_inicio')->nullable();
            $table->datetime('hora_fin')->nullable();
            $table->string('horas_transcurridas')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('time_logs');
    }
};
