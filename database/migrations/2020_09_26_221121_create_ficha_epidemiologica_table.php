<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichaEpidemiologicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ficha_epidemiologica', function (Blueprint $table) {
            $table->bigIncrements('id_fe');
            // LLAVE FORANEA A LA BASE DE DATOS TABLA ESTABLECIMIENTO / CENTRO DE SALUD
            $table->integer('id_est');
            // LLAVE FORANEA A LA BASE DE DATOS TABLA PERSONAL
            $table->integer('id_pac');
            // LLAVE FORANEA A LA TABLA ANTECEDENTES
            $table->unsignedBigInteger('id_ant');
            $table->foreign('id_ant')->references('id_ant')->on('antecedentes')->onDelete('cascade');
            // LLAVE FORANEA A LA TABLA DATOS CLINICOS
            $table->unsignedBigInteger('id_dc');
            $table->foreign('id_dc')->references('id_dc')->on('datos_clinicos')->onDelete('cascade');
            // LLAVE FORANEA A LA TABLA HOISPITALIZACION
            $table->unsignedBigInteger('id_hos');
            $table->foreign('id_hos')->references('id_hos')->on('hospitalizaciones')->onDelete('cascade');
            // LLAVE FORANEA A LA TABLA LABORATORIOS
            $table->unsignedBigInteger('id_lab');
            $table->foreign('id_lab')->references('id_lab')->on('laboratorios')->onDelete('cascade');
            // FIN
            $table->date('fecha_notificacion');
            $table->integer('sem_epidem');
            $table->boolean('caso_identificado');
            $table->integer('estado')->default(1);
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
        Schema::dropIfExists('ficha_epidemiologica');
    }
}
