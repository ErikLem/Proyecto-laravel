<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormulariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            // Datos propios del formulario
            $table->id();
            $table->string('estado');
            //1.- ACTIVIDADES PARA LAS QUE SE SOLICITA CONVALIDACIÓN
            $table->enum('actividades', [
                'Cursos y Seminarios Profesionales', 
                'Participación Estudiantil en Actividades Académicas, de Gestión, de Investigación y de Colaboración en Eventos Académicos **',
                'Represantación Estudiantil',
                'Estudiantes Mentores',
                'Representación de la Institución de competencias deportivas',
                'Actividades solidarias y de cooperación',
                'Experiencia Laboral',
                'Idiomas diferenctes al Inglés y Lengua Materna',
                'Dirección de ramas de organizaciones estudiantiles académicas',
                'Representación de la Institución en competencias académicas',
                'Coro y Grupo de Cámara',
                'Participación en la dirección de asociaciones de estudiantes',
                'Participación en juntas receptoras del voto'
                ])->nullable();
            //2.- DATOS DEL ESTUDIANTE
            $table->unsignedBigInteger('estudiante_id');
            $table->foreign('estudiante_id')
                ->references('id')
                ->on('estudiantes')
                ->onDelete('cascade');
            $table->date('fecha_asignacion_tutor')->nullable();
            //3.- DOCUMENTACIÓN DE SOPORTE ADJUNTO
                // la documentación no se almacena en esta Base de datos
            //4.- INFORMACIÓN DE LAS ACTIVIDADES DONDE SE REALIZO LAS PRÁCTICAS
            $table->string('tipo_institucion')->nullable();  //saber si es nacional o internacional
            $table->string('razon_social_institucion')->nullable();  
            $table->string('ruc_institucion')->nullable();  
            $table->string('direccion_institucion')->nullable();  
            $table->string('telefono_institucion')->nullable();  
            $table->string('celular_institucion')->nullable();  
            $table->string('ciudad_pais_institucion')->nullable();  
            $table->string('correo_institucion')->nullable();  
            $table->string('tipo_institucion2')->nullable();  
            $table->string('campo_amplio_institucion')->nullable();  
            $table->string('campo_especifico_institucion')->nullable();  
            $table->string('codigo_proyecto_convenio')->nullable();  
            $table->string('nombre_proyecto_convenio')->nullable();
            //5.- INFORMACIÓN DE LAS ACTIVIDADES REALIZADAS
            $table->string('resumen_actividades')->nullable();
            $table->string('actividades_realizadas')->nullable();
            $table->string('aprendizaje_perfil')->nullable();
            $table->string('malla_curricular')->nullable();
            //6.- INFORMACIÓN ADICIONAL
            $table->date('fecha_inicio_actividades')->nullable();
            $table->date('fecha_fin_actividades')->nullable();
            $table->integer('horas_solicitadas')->nullable();
           //7.- DECLARACIÓN
            $table->date('fecha_declaracion')->nullable();
            $table->string('firma_declaracion')->nullable(); 
            //8.- INFORME DEL TUTOR
            $table->string('devolucion_subdecano')->nullable();
            $table->unsignedBigInteger('profesors_id')->nullable();
            $table->foreign('profesors_id')
                ->references('id')
                ->on('profesors')
                ->onDelete('cascade');
            $table->string('inf_tutor_Q1')->nullable();
            $table->string('inf_tutor_Q2')->nullable();
            $table->string('inf_tutor_Q3')->nullable();
            $table->string('recomendaciones_tutor')->nullable();
            $table->string('horas_sugeridas')->nullable();
            $table->date('fecha_recepcion_tutor')->nullable();
            $table->date('fecha_revision_tutor')->nullable();
            $table->string('firma_tutor')->nullable();
            $table->string('devolucion_tutor')->nullable();
            //9.- MIEMBRO DE LA CPP
            $table->date('fecha_recepcion_miembrocpp')->nullable();
            $table->date('fecha_revision_miembrocpp')->nullable();
            $table->string('recomendacion_miembro_cpp')->nullable();
            $table->string('devolucion_miembro_cpp')->nullable();
            //9.- COMISIÓN DE PRÁCTICAS PREPROFESIONALES
            $table->integer('horas_convalidades')->nullable();
            $table->integer('horas_convalidades_practicas')->nullable();
            $table->integer('horas_convalidades_comunitario')->nullable();
            $table->string('observaciones_cpp')->nullable();
            $table->date('fecha_recepcion_cpp')->nullable();
            $table->date('fecha_revision_cpp')->nullable();
            $table->string('firma_cpp')->nullable();
            $table->string('devolucion_cpp')->nullable();
            //10.- DECANO
            $table->date('fecha_recepcion_decano')->nullable();
            $table->date('fecha_autorizacion_decano')->nullable();
            $table->string('firma_decano')->nullable();
           
            // COMENTARIO DE RECHAZO
            $table->date('comentario_rechazo')->nullable();
            //INFORMACIÓN ADICONAL QUE ES INGRESADA POR COMPONENTE 2 
            //DE ESTE PROYECTO

            //TIME STAMPS
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
        Schema::dropIfExists('formularios');
    }
}
