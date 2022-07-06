<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_empresas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Id_Convenio');
            $table->foreign('Id_Convenio')->references('id')->on('convenios');
            $table->unsignedBigInteger('Id_EP');
            $table->foreign('Id_EP')->references('id')->on('empresa_proyectos');
            $table->unsignedBigInteger('Id_Tipo_EP');
            $table->foreign('Id_Tipo_EP')->references('id')->on('tipo_empresas');
            $table->string('Tutor_EP');
            $table->string('E_Mail');
            $table->string('Telf');
            $table->string('Cel');
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
        Schema::dropIfExists('datos_empresas');
    }
}
