<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnfermedadesBaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enfermedades_base', function (Blueprint $table) {
            $table->bigIncrements('id_eb');
            // LLAVE FORANEA EN LA TABLA ENFERMEDADES
            $table->unsignedBigInteger('id_fe');
            $table->foreign('id_fe')->references('id_fe')->on('ficha_epidemiologica');
            //FIN
            // LLAVE FORANEA EN LA TABLA ENFERMEDADES
            $table->unsignedBigInteger('id_enf');
            $table->foreign('id_enf')->references('id_enf')->on('enfermedades');
            //FIN
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
        Schema::dropIfExists('enfermedades_base');
    }
}
