<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalNotificadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_notificado', function (Blueprint $table) {
            $table->bigIncrements('id_pn');
            // LLAVE FORANEA A LA TABLA USERS
            $table->unsignedBigInteger('id');
            $table->foreign('id')->references('id')->on('users')->onDelete('cascade');
            //FIN
            $table->string('nombre_notifica')->nullable();
            $table->string('paterno_notifica')->nullable();
            $table->string('materno_notifica')->nullable();
            $table->string('tel_cel_notifica')->nullable();
            $table->string('matricula_profesional')->nullable();
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
        Schema::dropIfExists('personal_notificado');
    }
}
