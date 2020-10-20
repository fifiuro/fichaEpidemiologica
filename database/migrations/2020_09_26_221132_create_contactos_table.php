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
            $table->foreign('id_fe')->references('id_fe')->on('ficha_epidemiologica')->onDelete('cascade');
            //FIN
            $table->string('nombre_contacto')->nullable();
            $table->string('paterno_contacto')->nullable();
            $table->string('materno_contacto')->nullable();
            // LLAVE FORANEA A LA TABLA RELACIONES
            $table->unsignedBigInteger('id_rel');
            $table->foreign('id_rel')->references('id_rel')->on('relacion');
            //FIN
            $table->integer('edad')->nullable();
            $table->string('telefono')->nullable();
            $table->string('direccion')->nullable();
            $table->date('fecha_contacto')->nullable();
            $table->string('lugar_contacto')->nullable();

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
