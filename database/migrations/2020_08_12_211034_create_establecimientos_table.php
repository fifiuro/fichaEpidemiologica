<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstablecimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establecimientos', function (Blueprint $table) {
            $table->bigIncrements('id_est');
            $table->string('establecimiento')->nullable();
            $table->string('codigo')->nullable();
            $table->string('red')->nullable();
            $table->string('departamento')->nullable();
            $table->string('municipio')->nullable();
            $table->date('fecha_notificacion')->nullable();
            $table->string('sem_epidem')->nullable();
            $table->boolean('caso_identificado')->nullable();
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
        Schema::dropIfExists('establecimientos');
    }
}
