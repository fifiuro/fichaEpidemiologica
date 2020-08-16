<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosClinicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_clinicos', function (Blueprint $table) {
            $table->bigIncrements('id_dc');
            $table->date('fecha_inicio')->nullable();
            $table->string('sintomas')->nullable();
            // LLAVE FORANEA A LA TABLA ESTADOS_PACIENTES
            $table->unsignedBigInteger('id_est');
            $table->foreign('id_est')->references('id_est')->on('estados_pacientes');
            // FIN
            $table->date('fecha_estado')->nullable();
            // LLAVE FORANEA A LA TABLA DIAGNOSTICO
            $table->unsignedBigInteger('id_dia');
            $table->foreign('id_dia')->references('id_dia')->on('diagnosticos');
            // FIN
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
        Schema::dropIfExists('datos_clinicos');
    }
}
