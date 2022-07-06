<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosConvalidacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_convalidacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Id_Convalidacion');
            $table->foreign('Id_Convalidacion')->references('id')->on('convalidacions');
            $table->unsignedBigInteger('Id_Tipo_Convalidacion');
            $table->foreign('Id_Tipo_Convalidacion')->references('id')->on('tipo_convalidacions');
            $table->string('Detalle');
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
        Schema::dropIfExists('datos_convalidacions');
    }
}
