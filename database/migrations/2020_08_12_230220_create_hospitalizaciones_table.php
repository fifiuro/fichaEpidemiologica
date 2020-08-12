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
            $table->date('fecha_aislamiento');
            $table->string('lugar_aislamiento');
            $table->date('fecha_internacion');
            $table->string('establecimiento');
            $table->boolean('ventilacion');
            $table->boolean('terapia_intensiva');
            $table->date('fecha_ingreso_uti');
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
