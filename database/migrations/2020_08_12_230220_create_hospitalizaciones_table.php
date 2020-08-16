<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHospitalizacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitalizaciones', function (Blueprint $table) {
            $table->bigIncrements('id_hos');
            $table->date('fecha_aislamiento')->nullable();
            $table->string('lugar_aislamiento')->nullable();
            $table->date('fecha_internacion')->nullable();
            $table->string('establecimiento')->nullable();
            $table->boolean('ventilacion')->nullable();
            $table->boolean('terapia_intensiva')->nullable();
            $table->date('fecha_ingreso_uti')->nullable();
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
        Schema::dropIfExists('hospitalizaciones');
    }
}
