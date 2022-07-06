<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInformacionsoportesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informacionsoportes', function (Blueprint $table) {
            $table->id();
            $table->string('url_archivo')->nullable();
            $table->unsignedBigInteger('formulario_id')->nullable();
            $table->foreign('formulario_id')
                ->references('id')
                ->on('formularios')
                ->onDelete('cascade');
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
        Schema::dropIfExists('informacionsoportes');
    }
}
