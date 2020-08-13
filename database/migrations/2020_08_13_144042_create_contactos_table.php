<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->bigIncrements('id_cont');
            // LLAVE FORANEA A LA TABLA FICHA EPIDEMILOGICA
            $table->unsignedBigInteger('id_fe');
            $table->foreign('id_fe')->references('id_fe')->on('ficha_epidemiologica');
            //FIN
            $table->string('nombre_contacto');
            $table->string('paterno_contacto');
            $table->string('materno_contacto');
            // LLAVE FORANEA A LA TABLA RELACIONES
            $table->unsignedBigInteger('id_rel');
            $table->foreign('id_rel')->references('id_rel')->on('relacion');
            //FIN
            $table->integer('edad');
            $table->string('telefono');
            $table->string('direccion');
            $table->date('fecha_contacto');
            $table->string('lugar_contacto');

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
        Schema::dropIfExists('contactos');
    }
}
