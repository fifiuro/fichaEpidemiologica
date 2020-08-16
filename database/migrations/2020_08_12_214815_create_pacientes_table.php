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
            $table->string('nombre_pacientes')->nullable();
            $table->string('paterno_pacientes')->nullable();
            $table->string('materno_pacientes')->nullable();
            $table->string('seguro_pacientes')->nullable();
            $table->string('sexo')->nullable();
            $table->string('ci')->nullable();
            $table->string('expedido')->nullable();
            $table->date('fecha_nac')->nullable();
            $table->integer('edad')->nullable();
            // LLAVE FORANEA A LA TABLA DEPARTAMENTOS
            $table->unsignedBigInteger('id_dep');
            $table->foreign('id_dep')->references('id_dep')->on('departamentos_estados');
            // FIN
            $table->string('municipio_paciente')->nullable();
            // LLAVE FORANEA A LA TABLA PAISES
            $table->unsignedBigInteger('id_pai');
            $table->foreign('id_pai')->references('id_pai')->on('paises');
            // FIN
            $table->string('calle')->nullable();
            $table->string('zona')->nullable();
            $table->string('num')->nullable();
            $table->string('telefono')->nullable();

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
