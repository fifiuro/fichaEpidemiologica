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
            // LLAVE FORANEA A LA TABLA FICHAS EPIDEMIOLOGIA
            $table->unsignedBigInteger('id_lab');
            $table->foreign('id_lab')->references('id_lab')->on('laboratorios')->onDelete('cascade');
            //FIN
            $table->string('nombre_notifica')->nullable();
            $table->string('paterno_notifica')->nullable();
            $table->string('materno_notifica')->nullable();
            $table->string('tel_cel_notifica')->nullable();
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
