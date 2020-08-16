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
            //FIN
            $table->boolean('vacuna_influenza')->nullable();
            $table->date('fecha_vacunacion')->nullable();
            $table->boolean('viaje_riesgo')->nullable();
            // LLAVE FORANEA DE LA TABLA PAISES
            $table->unsignedBigInteger('id_pai');
            $table->foreign('id_pai')->references('id_pai')->on('paises');
            //FIN
            $table->string('ciudad')->nullable();
            $table->date('fecha_retorno')->nullable();
            $table->time('hora_retorno')->nullable();
            $table->string('empresa_viaje')->nullable();
            $table->string('num_vuelo')->nullable();
            $table->string('num_asiento')->nullable();
            $table->boolean('contacto')->nullable();
            $table->date('fecha_contacto')->nullable();
            $table->string('nombre_contacto')->nullable();
            $table->string('paterno_contacto')->nullable();
            $table->string('materno_contacto')->nullable();
            $table->string('telefono_contacto')->nullable();
            // LLAVE FORANEA DE LA TABLA PAISES
            $table->unsignedBigInteger('pais_contacto');
            $table->foreign('pais_contacto')->references('id_pai')->on('paises');
            // FIN
            $table->string('departamento_contacto');
            $table->string('municipio_contacto')->nullable();
            $table->string('ciudad_contacto')->nullable();

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
