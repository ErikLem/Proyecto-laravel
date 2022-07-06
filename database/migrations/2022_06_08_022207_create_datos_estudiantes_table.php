<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_estudiantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Id_Estudiante');
            $table->foreign('Id_Estudiante')->references('id')->on('estudiantes');
            $table->integer('Horas');
            $table->unsignedBigInteger('Id_TipoPractica');
            $table->foreign('Id_TipoPractica')->references('id')->on('tipo_practicas');
            $table->string('Inicio');
            $table->string('Fin');
            $table->unsignedBigInteger('Id_Periodo');
            $table->foreign('Id_Periodo')->references('id')->on('periodos');
            $table->unsignedBigInteger('Id_Tutor');
            $table->foreign('Id_Tutor')->references('id')->on('tutors');
            $table->unsignedBigInteger('Id_Informe');
            $table->foreign('Id_Informe')->references('id')->on('informes');
            $table->unsignedBigInteger('Id_Encuesta');
            $table->foreign('Id_Encuesta')->references('id')->on('encuestas');
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
        Schema::dropIfExists('datos_estudiantes');
    }
}
