<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartamentosEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departamentos_estados', function (Blueprint $table) {
            $table->bigIncrements('id_dep');
            // LLAVE FORANEA A LA TABLA PAISES
            $table->unsignedBigInteger('id_pai');
            $table->foreign('id_pai')->references('id_pai')->on('paises');

            $table->string('departamento');
            $table->boolean('estado');
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
        Schema::dropIfExists('departamentos_estados');
    }
}
