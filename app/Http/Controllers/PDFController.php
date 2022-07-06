<?php
  
namespace App\Http\Controllers;

use App\Models\Estudiante;
use App\Models\Formulario;
use App\Models\Informacionadicional;
use App\Models\Informacionsoporte;
use App\Models\Profesor;
use App\Models\Role_user;
use App\Models\User;
use App\Models\userRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;
  
class PDFController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($id)
    {
            //
            $formulario = Formulario::find($id); 
            $estudiante_id = $formulario->estudiante_id;
            $profesor_id = $formulario->profesors_id;
            $estudiante = Estudiante::find($estudiante_id);
            $profesor = Profesor::find($profesor_id);
        // pasamos la información del decano y la comision
        // datos de la comision
        $user_rol = userRole::where('role_id','=','4')->first(); // Rol de la presidenta = 4
        $comision = User::find($user_rol->model_id);

        // datos del decano
        $user_rol = userRole::where('role_id','=','3')->first(); // Rol de la presidenta = 3
        $decano = User::find($user_rol->model_id);

                //archivos
        $doc_soporte = Informacionsoporte::where('formulario_id',$formulario->id)->get(); 
        $doc_adicional = Informacionadicional::where('formulario_id',$formulario->id)->get();

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'formulario_tipo' => 'FCP_001A',
            'version' => '2',
            'carrera' => $estudiante->carrera,
            //1.- ACTIVIDADES PARA LAS QUE SE SOLICITA CONVALIDACIÓN
            'actividades' => $formulario->actividades,
            //2.- DATOS DEL ESTUDIANTE
            'nombre_estudiante' => $estudiante->nombres .$estudiante->apellidos,
            'cedula_estudiante' => $estudiante->cedula,
            'correo_estudiante' => $estudiante->correo,
            'telefono_estudiante' => $estudiante->telefono,
            'celular_estudiante' => $estudiante->celular,
            //4.- INFORMACIÓN DE LAS ACTIVIDADES DONDE SE REALIZO LAS PRÁCTICAS
            
            'razon_social' => $formulario->razon_social_institucion,
            'ruc' => $formulario->ruc_institucion,
            'direccion' => $formulario->direccion_institucion, 
            'telefono_institucion' => $formulario->telefono_institucion,
            'celular_institucion' => $formulario->celular_institucion,
            'ciudad_pais' => $formulario->ciudad_pais_institucion,
            'correo_institucion' => $formulario->correo_institucion,
            'tipo_institucion' => $formulario->tipo_institucion2,
            'campo_amplio' => $formulario->campo_amplio_institucion,
            'campo_especifico' => $formulario->campo_especifico_institucion,
            'codigo_proyecto_convenio' => $formulario->codigo_proyecto_convenio,
            'nombre_proyecto_convenio' => $formulario->nombre_proyecto_convenio,
            //5.- INFORMACIÓN DE LAS ACTIVIDADES REALIZADAS
            'resumen_actividades' => $formulario->resumen_actividades,
            'actividades_realizadas' => $formulario->actividades_realizadas,
            'aprendizaje_perfil' => $formulario->aprendizaje_perfil,
            'malla_curricular' => $formulario->malla_curricular,
            //6.- INFORMACIÓN ADICIONAL
            'fecha_inicio_actividades' => $formulario->fecha_inicio_actividades,
            'fecha_fin_actividades' => $formulario->fecha_fin_actividades,
            'horas_solicitadas' => $formulario->horas_solicitadas,
           //7.- DECLARACIÓN
            'fecha_declaracion' => $formulario->fecha_declaracion,
            //8.- INFORME DEL TUTOR
            'nombre_profesor' => $profesor->nombres .$profesor->apellidos,
            'departamento_profesor' => $profesor->departamento,
            'inf_tutor_Q1' => $formulario->inf_tutor_Q1,
            'inf_tutor_Q2' => $formulario->inf_tutor_Q2,
            'inf_tutor_Q3' => $formulario->inf_tutor_Q3,
            'recomendaciones_tutor' => $formulario->recomendaciones_tutor,
            'horas_sugeridas' => $formulario->horas_sugeridas,
            'fecha_recepcion_tutor' => $formulario->fecha_recepcion_tutor,
            'fecha_revision_tutor' => $formulario->fecha_revision_tutor,
            //9.- COMISIÓN DE PRÁCTICAS PREPROFESIONALES
            'horas_convalidades' => $formulario->horas_convalidades,
            'horas_convalidades_practicas' => $formulario->horas_convalidades_practicas,
            'horas_convalidades_comunitario' => $formulario->horas_convalidades_comunitario,
            'observaciones_cpp' => $formulario->observaciones_cpp,
            'fecha_recepcion_cpp' => $formulario->fecha_recepcion_cpp,
            'fecha_revision_cpp' => $formulario->fecha_revision_cpp,
            'nombre_presidente_cpp' => $comision->name,
            //10.- DECANO
            'fecha_recepcion_decano' => $formulario->fecha_recepcion_decano,
            'fecha_autorizacion_decano' => $formulario->fecha_autorizacion_decano,
            'nombre_decano' => $decano->name,
            'firma_declaracion' => $formulario->firma_declaracion,
            'firma_tutor' => $formulario->firma_tutor,
            'firma_cpp' => $formulario->firma_cpp,
            'firma_decano' => $formulario->firma_decano,
            'Doc_soporte' => $doc_soporte,
            'Doc_adicional' => $doc_adicional

        ];
          
        
        

        //GUARDAR PDF
            // $pdf_name = $estudiante->nombres.$estudiante->apellidos.'FCP_001A_FORMULARIO.pdf';
            // $path = 'public/'.$estudiante->epn.'/'.$formulario->id.'/informacion_adicional';
            // $pdf1 = PDF::loadView('formulario.myPDF', $data)->setPaper('a4')->output();

            // Storage::disk($path)->put($pdf_name, $pdf1);
        
        // IMPRIMIR PDF
            $pdf = PDF::loadView('formulario.myPDF', $data)->setPaper('a4');
            
        return $pdf->download($estudiante->nombres.$estudiante->apellidos.'FCP_001A_FORMULARIO.pdf', $data);
        //return view('formulario.myPDF', $data);
    }
}