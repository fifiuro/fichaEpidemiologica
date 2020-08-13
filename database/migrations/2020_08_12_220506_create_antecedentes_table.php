<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntecedentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antecedentes', function (Blueprint $table) {
            $table->bigIncrements('id_ant');
            // LLAVE FORANEA DE LA TABLA OCUPACIONES
            $table->unsignedBigInteger('id_ocu');
            $table->foreign('id_ocu')->references('id_ocu')->on('ocupaciones');

            $table->boolean('vacuna_influenza');
            $table->date('fecha_vacunacion');
            $table->boolean('viaje_riesgo');
            // LLAVE FORANEA DE LA TABLA PAISES
            $table->unsignedBigInteger('id_pai');
            $table->foreign('id_pai')->references('id_pai')->on('paises');

            $table->string('ciudad');
            $table->date('fecha_retorno');
            $table->time('hora_retorno');
            $table->string('empresa_viaje');
            $table->string('num_vuelo');
            $table->string('num_asiento');
            $table->boolean('contacto');
            $table->date('fecha_contacto');
            $table->string('nombre_contacto');
            $table->string('paterno_contacto');
            $table->string('materno_contacto');
            $table->string('telefono_contacto');
            // LLAVE FORANEA DE LA TABLA PAISES
            $table->unsignedBigInteger('pais_contacto');
            $table->foreign('pais_contacto')->references('id_pai')->on('paises');
            // LLAVE FORANEA DE LA TABLA DEPARTAMENTOS ESTADOS
            $table->unsignedBigInteger('departamento_contacto');
            $table->foreign('departamento_contacto')->references('id_dep')->on('departamentos_estados');
            // LLAVE FORANEA DE LA TABLA MUNICIPIOS
            $table->string('municipio_contacto');

            $table->string('ciudad_contacto');

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
        Schema::dropIfExists('antecedentes');
    }
}
