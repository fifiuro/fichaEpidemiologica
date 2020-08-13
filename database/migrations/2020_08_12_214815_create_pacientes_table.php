<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->bigIncrements('id_pac');
            $table->string('nombre_pacientes');
            $table->string('paterno_pacientes');
            $table->string('materno_pacientes');
            $table->string('sexo');
            $table->string('ci');
            $table->string('expedido');
            $table->date('fecha_nac');
            $table->integer('edad');
            // LLAVE FORANEA A LA TABLA DEPARTAMENTOS
            $table->unsignedBigInteger('id_dep');
            $table->foreign('id_dep')->references('id_dep')->on('departamentos_estados');
            // LLAVE FORANEA A LA TABLA MUNICIPIOS
            $table->unsignedBigInteger('id_mun');
            $table->foreign('id_mun')->references('id_mun')->on('municipios');
            // LLAVE FORANEA A LA TABLA PAISES
            $table->unsignedBigInteger('id_pai');
            $table->foreign('id_pai')->references('id_pai')->on('paises');

            $table->string('calle');
            $table->string('zona');
            $table->integer('num');
            $table->string('telefono');

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
        Schema::dropIfExists('pacientes');
    }
}