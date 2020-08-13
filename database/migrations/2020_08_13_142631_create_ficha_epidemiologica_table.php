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
            // LLAVE FORANEA A LA TABLA ESTABLECIMIENTO
            $table->unsignedBigInteger('id_est');
            $table->foreign('id_est')->references('id_est')->on('establecimientos');
            // LLAVE FORANEA A LA TABLA PACIENTES
            $table->unsignedBigInteger('id_pac');
            $table->foreign('id_pac')->references('id_pac')->on('pacientes');
            // LLAVE FORANEA A LA TABLA ANTECEDENTES
            $table->unsignedBigInteger('id_ant');
            $table->foreign('id_ant')->references('id_ant')->on('antecedentes');
            // LLAVE FORANEA A LA TABLA DATOS CLINICOS
            $table->unsignedBigInteger('id_dc');
            $table->foreign('id_dc')->references('id_dc')->on('datos_clinicos');
            // LLAVE FORANEA A LA TABLA HOISPITALIZACION
            $table->unsignedBigInteger('id_hos');
            $table->foreign('id_hos')->references('id_hos')->on('hospitalizaciones');
            // LLAVE FORANEA A LA TABLA ENFERMEDAD BASE
            $table->unsignedBigInteger('id_eb');
            $table->foreign('id_eb')->references('id_eb')->on('enfermedades_base');
            // LLAVE FORANEA A LA TABLA LABORATORIO
            $table->unsignedBigInteger('id_lab');
            $table->foreign('id_lab')->references('id_lab')->on('laboratorios');
            // LLAVE FORANEA A LA TABLA PERSONAL NOTIFICA
            $table->unsignedBigInteger('id_pn');
            $table->foreign('id_pn')->references('id_pn')->on('personal_notifica');
            
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
