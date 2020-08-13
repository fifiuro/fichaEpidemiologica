<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalNotificaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_notifica', function (Blueprint $table) {
            $table->bigIncrements('id_pn');
            $table->string('nombre_notifica');
            $table->string('paterno_notifica');
            $table->string('materno_notifica');
            $table->string('tel_cel_notifica');
            $table->date('fecha_notifica');
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
        Schema::dropIfExists('personal_notifica');
    }
}
