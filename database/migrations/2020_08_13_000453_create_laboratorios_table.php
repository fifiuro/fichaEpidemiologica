<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratorios', function (Blueprint $table) {
            $table->bigIncrements('id_lab');
            $table->boolean('muestra');
            $table->string('lugar_muestra');
            // LLAVE FORANEA A LA TABLA MUESTRAS
            $table->unsignedBigInteger('id_mue');
            $table->foreign('id_mue')->references('id_mue')->on('muestras');
            //FIN
            $table->string('otro_muestra');
            $table->string('nombre_laboratorio');
            $table->date('fecha_muestra');
            $table->date('fecha_envio');
            $table->string('responsable_muestra');
            $table->text('observaciones');
            $table->boolean('resultado_laboratorio');
            $table->date('fecha_resultado');

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
        Schema::dropIfExists('laboratorios');
    }
}
