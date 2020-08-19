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
            // LLAVE FORANEA A LA TABLA FICHAS EPIDEMIOLOGIA
            $table->unsignedBigInteger('id_fe');
            $table->foreign('id_fe')->references('id_fe')->on('ficha_epidemiologica')->onDelete('cascade');
            //FIN
            $table->boolean('muestra')->nullable();
            $table->string('lugar_muestra')->nullable();
            $table->string('nombre_laboratorio')->nullable();
            $table->date('fecha_muestra')->nullable();
            $table->date('fecha_envio')->nullable();
            $table->string('responsable_muestra')->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('resultado_laboratorio')->nullable();
            $table->date('fecha_resultado')->nullable();

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
