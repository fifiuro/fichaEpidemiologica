<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menores', function (Blueprint $table) {
            $table->bigIncrements('id_men');
            // LLAVE FORANEA A LA TABLA PACIENTES
            $table->unsignedBigInteger('id_pac');
            $table->foreign('id_pac')->references('id_pac')->on('pacientes');
            //FIN
            // LLAVE FORANEA A LA TABLA RELACIONES
            $table->unsignedBigInteger('id_rel');
            $table->foreign('id_rel')->references('id_rel')->on('relacion');
            //FIN
            $table->string('nombre_relacion');
            $table->string('paterno_relacion');
            $table->string('materno_relacion');
            $table->string('tel_cel');
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
        Schema::dropIfExists('menores');
    }
}
