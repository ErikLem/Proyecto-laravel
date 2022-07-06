<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Id_DatosEstudiante');
            $table->foreign('Id_DatosEstudiante')->references('id')->on('datos_estudiantes');
            $table->unsignedBigInteger('Id_DatosEmpresa');
            $table->foreign('Id_DatosEmpresa')->references('id')->on('datos_empresas');
            $table->unsignedBigInteger('DatosConvalidacion');
            $table->foreign('DatosConvalidacion')->references('id')->on('datos_convalidacions');
            $table->unsignedBigInteger('Id_DatosSeguimiento');
            $table->foreign('Id_DatosSeguimiento')->references('id')->on('datos_seguimientos');
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
        Schema::dropIfExists('registros');
    }
}
