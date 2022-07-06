<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_seguimientos', function (Blueprint $table) {
            $table->id();
            $table->string('Fecha_Ingreso');
            $table->string('Fecha_Val_CPPP');
            $table->string('Fecha_Cert');
            $table->string('Fecha_Reg_Sis');
            $table->string('Obs');
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
        Schema::dropIfExists('datos_seguimientos');
    }
}



