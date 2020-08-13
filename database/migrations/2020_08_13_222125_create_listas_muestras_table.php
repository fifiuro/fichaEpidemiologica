<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListasMuestrasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listas_muestras', function (Blueprint $table) {
            $table->bigIncrements('id_lm');
            // LLAVE FORANEA A LA TABLA LABORATORIOS
            $table->unsignedBigInteger('id_lab');
            $table->foreign('id_lab')->references('id_lab')->on('laboratorios');
            //FIN
            // LLAVE FORANEA A LA TABLA MUESTRAS
            $table->unsignedBigInteger('id_mue');
            $table->foreign('id_mue')->references('id_mue')->on('muestras');
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
        Schema::dropIfExists('listas_muestras');
    }
}
