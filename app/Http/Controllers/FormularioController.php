<?php

namespace App\Http\Controllers;

use App\Models\Formulario;
use App\Models\Estudiante;
use App\Models\Informacionadicional;
use App\Models\Informacionsoporte;
use App\Models\Profesor;
use App\Models\User;
use App\Models\userRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;


class FormularioController extends Controller
{
    public function nuevoFormulario(Request $request)
    {
               //Consultado la API del SRI
            //    try {
            //     if($request->cookie('XSRF-TOKEN') != ""){
            //     $response = Http::post('http://127.0.0.1:8080/api/srisRUC');
            //     $instituciones = $response; 
            //     }
            //     } catch (\Throwable $th) {
            // //     //echo $th;
            //     return response()->json($th, 403); 
            //      } 
                 
                //  return Log::debug($instituciones);
                //  return $instituciones;
                //  $profesores = Profesor::all();
                //  return $profesores;

        // Envio de datos a la vista crear nuevo formulario
        $id = $request->user()->id;
        $user = DB::table('estudiantes')->where('user_id', $id)->first();
        $nombres = $user->nombres.' '.$user->apellidos;
        $epn = $user->epn;
        $carrera = $user->carrera;
        $cedula = $user->cedula;
        $correo = $user->correo;
        $telefono = $user->telefono;
        $celular = $user->celular;
        // $profesores = $instituciones;
        //dd($user);        
        return view('estudiante.nuevo-formulario', [
            'id' => $id,
            'epn' => $epn,
            'name' => $nombres, 
            'carrera' => $carrera,
            'cedula' => $cedula,
            'correo' => $correo,
            'telefono' => $telefono,
            'celular' => $celular,
            // 'profesores' => $profesores,
            // 'instituciones' => $instituciones // Ya le paso las instituciones al avista
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     // INDEX PARA VER LOS NUEVOS FORMULARIOS
    public function index()
    {
        if(auth()->user()->roles->pluck('name')->first() == 'Subdecano')
        {
            $profesores = Profesor::all();
            //dd($profesores);
            $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'proceso')
            ->where('profesors_id', '=', NULL)->where('firma_declaracion', '!=', NULL)->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);
        }else
        if(auth()->user()->roles->pluck('name')->first() == 'Estudiante')
        {
            $user_id = auth()->user()->id;
            $formularios = Formulario::select('formularios.*')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
            ->where('user_id', '=', $user_id)->where('estado', '=', 'proceso')->where('firma_declaracion', '!=', NULL)
            ->where('firma_tutor', '=', NULL)
            ->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);
        }else
        if(auth()->user()->roles->pluck('name')->first() == 'Tutor')
        {
            $user_id = auth()->user()->id;
            $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->join('profesors', 'formularios.profesors_id', '=', 'profesors.id')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
            ->where('profesors.user_id', '=', $user_id)->where('estado', '=', 'proceso')->where('firma_tutor', '=', NULL)
            ->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);
        }else
        if(auth()->user()->roles->pluck('name')->first() == 'Miembro CPPP'){
            $user_id = auth()->user()->id;
            $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'proceso')
            ->where('firma_tutor', '!=', NULL)->where('firma_cpp', '=', NULL)->where('recomendacion_miembro_cpp', '=', NULL)->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);    
        }else
        if(auth()->user()->roles->pluck('name')->first() == 'Coordinador CPPP'){
            $user_id = auth()->user()->id;
            $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'proceso')
            ->where('firma_tutor', '!=', NULL)->where('firma_cpp', '=', NULL)->where('recomendacion_miembro_cpp', '!=', NULL)->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);    
        }else
        if(auth()->user()->roles->pluck('name')->first() == 'Decano'){
            $user_id = auth()->user()->id;
            $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'proceso')
            ->where('firma_tutor', '!=', NULL)->where('firma_cpp', '!=', NULL)->where('firma_decano', '=', NULL)->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);    
        }
        else{
            return view('home');
        }
    }


    // FUNCION PARA MOSTRAR LOS FORMULARIOS RECHAZADOS
    // Los formularios rechazados, se podran ver unicamente CPP, Tutor, Subdecano, Estudiante
    // veran todos los rechazados sin importar quien lo rechazd
    public function indexRechazado()
    {
        if(auth()->user()->roles->pluck('name')->first() == 'Subdecano' || auth()->user()->roles->pluck('name')->first() == 'Tutor' || auth()->user()->roles->pluck('name')->first() == 'Coordinador CPPP' || auth()->user()->roles->pluck('name')->first() == 'Miembro CPPP')
        {
            $profesores = Profesor::all();
            //dd($profesores);
            $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'rechazado')
            ->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);
        }else
        if(auth()->user()->roles->pluck('name')->first() == 'Estudiante')
        {
            $user_id = auth()->user()->id;
            $formularios = Formulario::select('formularios.*')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
            ->where('user_id', '=', $user_id)->where('estado', '=', 'rechazado')
            ->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);
        }
        // else
        // if(auth()->user()->roles->pluck('name')->first() == 'Tutor')
        // {
        //     $user_id = auth()->user()->id;
        //     $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
        //     ->join('profesors', 'formularios.profesors_id', '=', 'profesors.id')
        //     ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
        //     ->where('profesors.user_id', '=', $user_id)->where('estado', '=', 'rechazado')->where('recomendacion_miembro_cpp ', '=', NULL)
        //     ->get(); // or first() 
        //     return view('formulario.index', ['formularios' => $formularios]);
        // }
        // else
        // if(auth()->user()->roles->pluck('name')->first() == 'Coordinador CPPP'){
        //     $user_id = auth()->user()->id;
        //     $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
        //     ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'rechazado')
        //     ->get(); // or first() 
        //     return view('formulario.index', ['formularios' => $formularios]);    
        // }
        else{
            return view('home');
        }
    }
    
    // INDEX PARA VER LOS FORMULARIOS QUE YA FUERON LLENADOS POR CADA ACTOR
    public function indexAceptado() // SOLO PARA TUTOR, SUBDECANO, MIMBRO COMISION,  COMISION Y DECANO
    {
        // Este if muestra los formularios a los que ya se le asigno un tutor
        if(auth()->user()->roles->pluck('name')->first() == 'Subdecano')
        {
            $profesores = Profesor::all();
            //dd($profesores);      
            $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('profesors_id', '!=', NULL)
            ->where('estado', '=', 'proceso')->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);
        }else
        if(auth()->user()->roles->pluck('name')->first() == 'Tutor')
        {
            $user_id = auth()->user()->id;
            $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->join('profesors', 'formularios.profesors_id', '=', 'profesors.id')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
            ->where('profesors.user_id', '=', $user_id)->where('firma_tutor', '!=', NULL)->where('estado', '=', 'proceso')
            ->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);
        }else
        if(auth()->user()->roles->pluck('name')->first() == 'Miembro CPPP'){
            $user_id = auth()->user()->id;
            $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'proceso')
            ->where('firma_tutor', '!=', NULL)->where('firma_cpp', '=', NULL)->where('recomendacion_miembro_cpp', '!=', NULL)->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);    
        }else
        if(auth()->user()->roles->pluck('name')->first() == 'Coordinador CPPP'){
            $user_id = auth()->user()->id;
            $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
            ->where('estado', '=', 'proceso')->where('recomendacion_miembro_cpp', '!=', NULL)->where('firma_cpp', '!=', NULL)->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);    
        }else
        if(auth()->user()->roles->pluck('name')->first() == 'Decano'){
            $user_id = auth()->user()->id;
            $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
            ->where('estado', '=', 'aceptado')->where('firma_tutor', '!=', NULL)->where('firma_cpp', '!=', NULL)
            ->where('firma_decano', '!=', NULL)->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);    
        }
        else{
            return view('home');
        }
    }



    // FUNCION PARA MOSTRAR LOS FORMULARIOS QUE YA COMPLETARON EL PROCESO
    // TOTALMENTE FINALIZADO
    public function indexCompletados()
    {
        
        // if(auth()->user()->roles->pluck('name')->first() == 'Subdecano')
        // {
        //     $profesores = Profesor::all();
        //     //dd($profesores);
        //     $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
        //     ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'rechazado')
        //     ->get(); // or first() 
        //     return view('formulario.index', ['formularios' => $formularios]);
        // }else
        if(auth()->user()->roles->pluck('name')->first() == 'Estudiante')
        {
            $user_id = auth()->user()->id;
            $formularios = Formulario::select('formularios.*')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
            ->where('user_id', '=', $user_id)->where('estado', '=', 'aceptado')
            ->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);
        }
        // else
        // if(auth()->user()->hasRole('tutor'))
        // {
        //     $user_id = auth()->user()->id;
        //     $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
        //     ->join('profesors', 'formularios.profesors_id', '=', 'profesors.id')
        //     ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
        //     ->where('profesors.user_id', '=', $user_id)
        //     ->get(); // or first() 
        //     return view('formulario.index', ['formularios' => $formularios]);
        // }
        else
        if(auth()->user()->roles->pluck('name')->first() == 'Coordinador CPPP'){
            $user_id = auth()->user()->id;
            $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
            ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'aceptado')
            ->get(); // or first() 
            return view('formulario.index', ['formularios' => $formularios]);    
        }
        else{
            return view('home');
        }
    }

    
        // FUNCION PARA MOSTRAR LOS FORMULARIOS DEVUELTOS PARA CORREGIR
        public function indexDevueltos()
        {
            if(auth()->user()->roles->pluck('name')->first() == 'Subdecano')
            {
                $profesores = Profesor::all();
                //dd($profesores);
                $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
                ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'corregir')
                ->where('profesors_id', '=', NULL)->where('firma_declaracion', '!=', NULL)->get(); // or first() 
                return view('formulario.index', ['formularios' => $formularios]);
            }else
            if(auth()->user()->roles->pluck('name')->first() == 'Estudiante')
            {
                $user_id = auth()->user()->id;
                $formularios = Formulario::select('formularios.*')
                ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
                ->where('user_id', '=', $user_id)->where('estado', '=', 'corregir')->where('firma_declaracion', '!=', NULL)
                ->get(); // or first() 
                return view('formulario.index', ['formularios' => $formularios]);
            }else
            if(auth()->user()->roles->pluck('name')->first() == 'Tutor')
            {
                $user_id = auth()->user()->id;
                $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
                ->join('profesors', 'formularios.profesors_id', '=', 'profesors.id')
                ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
                ->where('profesors.user_id', '=', $user_id)->where('estado', '=', 'corregir')->where('firma_tutor', '=', NULL)
                ->get(); // or first() 
                return view('formulario.index', ['formularios' => $formularios]);
            }else
            if(auth()->user()->roles->pluck('name')->first() == 'Miembro CPPP'){
                $user_id = auth()->user()->id;
                $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
                ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'corregir')
                ->where('firma_tutor', '!=', NULL)->where('firma_cpp', '=', NULL)->where('recomendacion_miembro_cpp', '=', NULL)->get(); // or first() 
                return view('formulario.index', ['formularios' => $formularios]);    
            }else
            if(auth()->user()->roles->pluck('name')->first() == 'Coordinador CPPP'){
                $user_id = auth()->user()->id;
                $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
                ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'corregir')
                ->where('firma_tutor', '!=', NULL)->where('firma_cpp', '=', NULL)->where('recomendacion_miembro_cpp', '!=', NULL)->get(); // or first() 
                return view('formulario.index', ['formularios' => $formularios]);    
            }else
            if(auth()->user()->roles->pluck('name')->first() == 'Decano'){
                $user_id = auth()->user()->id;
                $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
                ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'corregir')
                ->where('firma_tutor', '!=', NULL)->where('firma_cpp', '!=', NULL)->where('firma_decano', '=', NULL)->get(); // or first() 
                return view('formulario.index', ['formularios' => $formularios]);    
            }
            else{
                return view('home');
            }
    
        }

         // INDEX PARA VER LOS FORMULARIOS CORREGIDOS
         public function indexCorregidos()
         {
             if(auth()->user()->roles->pluck('name')->first() == 'Subdecano')
             {
                 $profesores = Profesor::all();
                 //dd($profesores);
                 $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
                 ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'corregido')
                 ->where('profesors_id', '=', NULL)->where('firma_declaracion', '!=', NULL)->get(); // or first() 
                 return view('formulario.index', ['formularios' => $formularios]);
             }else
             if(auth()->user()->roles->pluck('name')->first() == 'Estudiante')
             {
                 $user_id = auth()->user()->id;
                 $formularios = Formulario::select('formularios.*')
                 ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
                 ->where('user_id', '=', $user_id)->where('estado', '=', 'corregido')->where('firma_declaracion', '!=', NULL)
                 ->get(); // or first() 
                 return view('formulario.index', ['formularios' => $formularios]);
             }else
             if(auth()->user()->roles->pluck('name')->first() == 'Tutor')
             {
                 $user_id = auth()->user()->id;
                 $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
                 ->join('profesors', 'formularios.profesors_id', '=', 'profesors.id')
                 ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
                 ->where('profesors.user_id', '=', $user_id)->where('estado', '=', 'corregido')->where('firma_tutor', '=', NULL)
                 ->get(); // or first() 
                 return view('formulario.index', ['formularios' => $formularios]);
             }else
             if(auth()->user()->roles->pluck('name')->first() == 'Miembro CPPP'){
                 $user_id = auth()->user()->id;
                 $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
                 ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'corregido')
                 ->where('firma_tutor', '!=', NULL)->where('firma_cpp', '=', NULL)->where('recomendacion_miembro_cpp', '=', NULL)->get(); // or first() 
                 return view('formulario.index', ['formularios' => $formularios]);    
             }else
             if(auth()->user()->roles->pluck('name')->first() == 'Coordinador CPPP'){
                 $user_id = auth()->user()->id;
                 $formularios = Formulario::select('formularios.*', 'estudiantes.nombres', 'estudiantes.apellidos')
                 ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')->where('estado', '=', 'corregido')
                 ->where('firma_tutor', '!=', NULL)->where('firma_cpp', '=', NULL)->where('recomendacion_miembro_cpp', '!=', NULL)->get(); // or first() 
                 return view('formulario.index', ['formularios' => $formularios]);    
             }
             else{
                 return view('home');
             }
         }

         
    // Insertar datos del formulario por parte del estudiante

    public function store(Request $request)
    {
        

        $rules = [
            'actividad' => 'required',
            'cedula' => 'required|min:10|max:10',
            'correo' => 'required|min:6',
            'telefono' => 'required',
            'celular' => 'required',
            'documentacion_soporte' => 'required|max:5120',
            // 'ruc_institucion' => 'required',
            'razon_social_institucion' => 'required',
            'direccion_institucion' => 'required',
            'telefono_institucion' => 'required',
            'celular_institucion' => 'required',
            'ciudad_pais_institucion' => 'required',
            'tipo_institucion2' => 'required',
            'resumen_actividades' => 'required',
            'actividades_realizadas' => 'required',
            'aprendizaje_perfil' => 'required',
            'malla_curricular' => 'required',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'horas_solicitadas' => 'numeric|min:1',
            'firma_declaracion' => 'required|image|max:2048' 
        ];
    
        $customMessages = [
            'required' => 'El campo: :attribute es obligatorio.',
            'cedula.min' => 'El campo debe tener mínimo :min caracteres.',
            'horas_solicitadas.min' => 'Las horas solicitadas para convalidación deben ser mayor a :min hora.',
            'horas_solicitadas.numeric' => 'El campo solo acepta numeros.',
            'after' => 'La fecha de fin de actividades debe ser posterior a la fecha de inicio.',
            'firma_declaracion' => 'El campo firma de declaración solo acepta imagenes'
        ];
    
        $this->validate($request, $rules, $customMessages);

        $id = (int)$request->id;
        $estudiante = Estudiante::where('user_id', $id)->first();       
        $estudiante->update([
            'correo' => $request->correo,
            'telefono' => $request->telefono,
            'celular' => $request->celular,
        ]);

        
        $formulario = new Formulario; 
        $formulario->estudiante_id = (int) $estudiante->id; 
        $formulario->estado = "proceso"; 
        $formulario->resumen_actividades = $request->resumen_actividades; 
        $formulario->actividades_realizadas = $request->actividades_realizadas; 
        $formulario->aprendizaje_perfil = $request->aprendizaje_perfil; 
        $formulario->malla_curricular = $request->malla_curricular; 
        $formulario->fecha_inicio_actividades = $request->fecha_inicio; 
        $formulario->fecha_fin_actividades = $request->fecha_fin;
        $formulario->horas_solicitadas = (int) $request->horas_solicitadas; 
        $formulario->fecha_declaracion = $request->fecha_declaracion; 
        $formulario->tipo_institucion = $request->tipo_institucion;
        $formulario->razon_social_institucion = $request->razon_social_institucion;
        if($request->ruc_institucion == ""){
            $formulario->ruc_institucion ="N/A";
        }else{
            $formulario->ruc_institucion = $request->ruc_institucion;
        }
        $formulario->direccion_institucion = $request->direccion_institucion;
        $formulario->telefono_institucion = $request->telefono_institucion;
        $formulario->celular_institucion = $request->celular_institucion;
        $formulario->ciudad_pais_institucion = $request->ciudad_pais_institucion;
        $formulario->correo_institucion = $request->correo_institucion; 
        $formulario->tipo_institucion2 = $request->tipo_institucion2; 
        $formulario->campo_amplio_institucion = $request->campo_amplio_institucion;
        $formulario->campo_especifico_institucion = $request->campo_especifico_institucion; 
        $formulario->codigo_proyecto_convenio = $request->codigo_proyecto_institucion;
        $formulario->nombre_proyecto_convenio = $request->nombre_proyecto_institucion;
        $formulario->actividades = $request->actividad;
        
        $formulario->save();

        // Los archivos se guardan despues de tener el Id del formulario
        $makeDirectory = Storage::makeDirectory('public/'.$request->epn.'/'.$formulario->id);
        if($makeDirectory){
            if($request->hasfile('firma_declaracion')){
                $firma_doc = $request->file('firma_declaracion')->store('public/'.$request->epn.'/'.$formulario->id);
                $url = Storage::url($firma_doc);  
                $formulario->firma_declaracion = $url;
                $formulario->save();
            }else{
                echo "No se pudieron subir los documentos al servidor, por favor intente nuevamente.";
            } 
        }else{
            echo "No se pudo crear la carpeta para subir los documentos al servidor, por favor intente nuevamente.";
        } 
        

        
        //Crear Directorio de Documentacion de soporte adjunta
        $makeDirectory = Storage::makeDirectory('public/'.$request->epn.'/'.$formulario->id.'/informacion_de_soporte');

        if($makeDirectory){
            if($request->hasfile('documentacion_soporte')){
                $misdoc = $request->file('documentacion_soporte'); 
                foreach($misdoc as $file){
                    if(Storage::putFileAs('public/'.$request->epn.'/'.$formulario->id.'/informacion_de_soporte',$file,$file->getClientOriginalName())){
                        $Informacion_Soporte = new Informacionsoporte(); 
                        $Informacion_Soporte -> url_archivo = $file -> getClientOriginalName();
                        $Informacion_Soporte -> formulario_id = $formulario->id;
                        $Informacion_Soporte->save();
                    }                  
                  }

            }else{
                echo "No se pudieron subir los documentos al servidor, por favor intente nuevamente.";
            } 
        }else{
            echo "No se pudo crear la carpeta para subir los documentos al servidor, por favor intente nuevamente.";
        }    

        //Crear Directorio de Informacion Adicional
        $makeDirectoryAdicional = Storage::makeDirectory('public/'.$request->epn.'/'.$formulario->id.'/informacion_adicional');

        if($makeDirectoryAdicional){
            if($request->hasfile('informacion_adicional')){                
                $misdocAdicional = $request->file('informacion_adicional');                 
                foreach($misdocAdicional as $file){
                    if(Storage::putFileAs('public/'.$request->epn.'/'.$formulario->id.'/informacion_adicional',$file,$file->getClientOriginalName())){
                        $Informacion_adicional = new Informacionadicional(); 
                        $Informacion_adicional -> url_archivo = $file -> getClientOriginalName();
                        $Informacion_adicional -> formulario_id = $formulario->id;
                        $Informacion_adicional->save();
                    }                  
                  }
            }
            else
            {
                echo "No se pudieron subir los documentos al servidor, por favor intente nuevamente.";
            } 
        }
        else
        {
            echo "No se pudo crear la carpeta para subir los documentos al servidor, por favor intente nuevamente.";
        }   
        
        return redirect()->route('formulario')->with('enviado','ok');
        // //Aqui compruebo en que pantalla estoy
        // if($request->verificado === "Si"){
        //     $formulario->save();
        //     $user_id = auth()->user()->id;
        //     $formularios = Formulario::select('formularios.*')
        //     ->join('estudiantes', 'formularios.estudiante_id', '=', 'estudiantes.id')
        //     ->where('user_id', '=', $user_id)
        //     ->get(); // or first() 
        //     return view('formulario.index', ['formularios' => $formularios]);
        // }else{
        //     //dd('Aca');
        //     $profesores = Profesor::all();
        //     return view('estudiante.nuevo-formulario', [
        //         'formulario' => $formulario,
        //         'estudiante' => $estudiante,
        //         'carrera' => $estudiante->carrera,
        //         'id' => $estudiante->id,
        //         'epn' => $estudiante->epn,
        //         'name' => $estudiante->nombres,
        //         'cedula' => $estudiante->cedula,
        //         'correo' => $estudiante->correo,
        //         'telefono' => $estudiante->telefono,
        //         'celular' => $estudiante->celular,
        //     ]);
        // }
    }

    
    // Insertar datos por por el decano
    
    public function storeSubdecano(Request $request){


        $formulario_id = (int)$request->formulario_id;
        $profesor_id = (int)$request->tutor_id;
        $profesor = Profesor::where('id',$profesor_id)->first();
        $formulario = Formulario::where('id', $formulario_id)->first(); 
        $formulario->profesors_id = $profesor->id;
        $formulario->fecha_asignacion_tutor = $request -> fecha_asignacion_tutor;
        $formulario->estado = 'proceso';
        $formulario->save(); 
        
        return redirect()->route('formulario')->with('asignado','ok');
        //return route('/formulario');
    }

    // Insertar datos por parte del tutor

    public function storeTutor(Request $request){

        $rules = [
            'pregunta_tutor_1' => 'required',
            'pregunta_tutor_2' => 'required',
            'pregunta_tutor_3' => 'required',
            'analisis_recomendaciones_tutor' => 'required',
            'horas_validadas_tutor' => 'required',
            'firma_tutor' => 'required|image|max:2048'
  
        ];
    
        $customMessages = [
            'required' => 'El campo: :attribute es obligatorio.',
        ];
    
        
        $this->validate($request, $rules, $customMessages);

        $formulario_id = (int)$request->formulario_id;
        // $profesor = Profesor::find((int)$request->nombre_tutor_id)->first();
        $formulario = Formulario::find($formulario_id); 
        $formulario->inf_tutor_Q1 = $request->pregunta_tutor_1; 
        $formulario->inf_tutor_Q2 = $request->pregunta_tutor_2; 
        $formulario->inf_tutor_Q3 = $request->pregunta_tutor_3; 
        $formulario->recomendaciones_tutor = $request->analisis_recomendaciones_tutor; 
        $formulario->horas_sugeridas = $request->horas_validadas_tutor;
        $formulario->fecha_recepcion_tutor = $formulario->fecha_asignacion_tutor;
        $formulario->fecha_revision_tutor = $request->fecha_revision_tutor;
        $estudiante_id = $formulario->estudiante_id;
        $estudiante = Estudiante::find($estudiante_id);
        $epn=$estudiante->epn;
        $formulario->estado = 'proceso';
        $formulario->save();

          // Los archivos se guardan despues de tener el Id del formulario
          $makeDirectory = Storage::makeDirectory('public/'.$epn.'/'.$formulario->id);
          if($makeDirectory){
              if($request->hasfile('firma_tutor')){
                  $firma_doc = $request->file('firma_tutor')->store('public/'.$epn.'/'.$formulario->id);
                  $url = Storage::url($firma_doc);  
                  $formulario->firma_tutor = $url;
                  $formulario->save(); 
              }else{
                  echo "No se pudieron subir los documentos al servidor, por favor intente nuevamente.";
              } 
          }else{
              echo "No se pudo crear la carpeta para subir los documentos al servidor, por favor intente nuevamente.";
          } 

           
        
        return redirect()->route('formulario')->with('enviado','ok');
    }

        // Insertar datos por parte del mimbro de la comision

        public function storeMiembrocomision(Request $request){

            $rules = [
                'recomendacion_miembro_cpp' => 'required',

      
            ];
        
            $customMessages = [
                'required' => 'Recuerde que debe enviar su resomendación sobre la revisión de este proceso de convalidación',
            ];
        
            
            $this->validate($request, $rules, $customMessages);
    
            $formulario_id = (int)$request->formulario_id;
            // $profesor = Profesor::find((int)$request->nombre_tutor_id)->first();
            $formulario = Formulario::find($formulario_id); 
            $formulario->recomendacion_miembro_cpp = $request -> recomendacion_miembro_cpp;
            $formulario->fecha_revision_miembrocpp = $request -> fecha_revision_miembrocpp;
            $formulario->fecha_recepcion_miembrocpp = $formulario->fecha_revision_tutor;
            $formulario->estado = 'proceso';
            $formulario->save();
               
            
            return redirect()->route('formulario')->with('enviado','ok');
        }

    // Insertar datos por parte de la comision

    public function storeComision(Request $request){

        $rules = [
            'horas_convalidadas' => 'numeric|min:1',
            'horas_convalidadas_practicas' => 'numeric|min:1',
            'observaciones_cpp' => 'required',
            'firma_comision' => 'required|image|max:2048',
            'horas_convalidadas_practicas' => 'lte:horas_convalidadas'
  
        ];
    
        $customMessages = [
            'required' => 'El campo: :attribute es obligatorio.',
            'horas_convalidadas.min' => 'Las horas solicitadas para convalidación deben ser mayor a :min hora.',
            'horas_convalidadas.numeric' => 'El campo :attribute solo acepta numeros.',
            'horas_convalidadas_practicas.min' => 'Las horas solicitadas para convalidación deben ser mayor a :min hora.',
            'horas_convalidadas_practicas.numeric' => 'El campo :attribute solo acepta numeros.',
            'lte' => 'El campo: horas convalidadas de prácticas no puede ser mayor al total de horas convalidadas'
        ];
    
        
        $this->validate($request, $rules, $customMessages);
        $formulario_id = (int)$request->formulario_id;
        // $profesor = Profesor::find((int)$request->nombre_tutor_id)->first();
        $formulario = Formulario::find($formulario_id); 
        $formulario->estado = 'proceso';
        $formulario->horas_convalidades= $request->horas_convalidadas; 
        $formulario->horas_convalidades_practicas = $request->horas_convalidadas_practicas; 
        $formulario->horas_convalidades_comunitario = $request->horas_convalidadas_comunitario; 
        $formulario->observaciones_cpp = $request->observaciones_cpp; 
        $formulario->fecha_recepcion_cpp = $formulario->ffecha_revision_miembrocpp;
        $formulario->fecha_revision_cpp = $request->fecha_revision_comision;

        $estudiante_id = $formulario->estudiante_id;
        $estudiante = Estudiante::find($estudiante_id);
        $epn=$estudiante->epn;
        $formulario->save();

          // Los archivos se guardan despues de tener el Id del formulario
          $makeDirectory = Storage::makeDirectory('public/'.$epn.'/'.$formulario->id);
          if($makeDirectory){
              if($request->hasfile('firma_comision')){
                  $firma_doc = $request->file('firma_comision')->store('public/'.$epn.'/'.$formulario->id);
                  $url = Storage::url($firma_doc);  
                  $formulario->firma_cpp = $url;
                  $formulario->save(); 
              }else{
                  echo "No se pudieron subir los documentos al servidor, por favor intente nuevamente.";
              } 
          }else{
              echo "No se pudo crear la carpeta para subir los documentos al servidor, por favor intente nuevamente.";
          }    
        
        return redirect()->route('formulario')->with('enviado','ok');
    }

        // Insertar datos por parte del decano

        public function storeDecano(Request $request){

            $rules = [
                'firma_decano' => 'required|image|max:2048',
  
      
            ];
        
            $customMessages = [
                'required' => 'La firma es obligatorio.',
                'firma_decano.image' => 'El campo firma acepta solo imagenes'
            ];
        
            
            $this->validate($request, $rules, $customMessages);

            $formulario_id = (int)$request->formulario_id;
            // $profesor = Profesor::find((int)$request->nombre_tutor_id)->first();
            $formulario = Formulario::find($formulario_id); 
            $formulario->fecha_recepcion_decano = $formulario->fecha_revision_cpp;
            $formulario->fecha_autorizacion_decano = $request->fecha_revision_decano;
            $formulario->estado = 'aceptado';
            $formulario->save();
            
            $estudiante_id = $formulario->estudiante_id;
            $estudiante = Estudiante::find($estudiante_id);
            $epn=$estudiante->epn;
            $formulario->save();

            // Los archivos se guardan despues de tener el Id del formulario
            $makeDirectory = Storage::makeDirectory('public/'.$epn.'/'.$formulario->id);
            if($makeDirectory){
                if($request->hasfile('firma_decano')){
                    $firma_doc = $request->file('firma_decano')->store('public/'.$epn.'/'.$formulario->id);
                    $url = Storage::url($firma_doc);  
                    $formulario->firma_decano = $url;
                    $formulario->save(); 
                }else{
                    echo "No se pudieron subir los documentos al servidor, por favor intente nuevamente.";
                } 
            }else{
                echo "No se pudo crear la carpeta para subir los documentos al servidor, por favor intente nuevamente.";
            } 
                
            return redirect()->route('formulario')->with('completado','ok');
        }


        // SOLICITAR CORRECCION

        public function storeCorregir(Request $request){

            $formulario_id = (int)$request->formulario_id;
            $formulario = Formulario::find($formulario_id); 

            if(auth()->user()->roles->pluck('name')->first() == 'Subdecano')
            {
                $rules = [
                    'devolucion_subdecano' => 'required',
                ];
            
                $customMessages = [
                    'required' => 'Recuerde que debe especificar al estudiante las correcciones necesarias'
                ];
                
                $this->validate($request, $rules, $customMessages);
                $formulario->devolucion_subdecano = $request->devolucion_subdecano;
                $formulario->estado = 'corregir';
                $formulario->save();
                
            }else
            if(auth()->user()->roles->pluck('name')->first() == 'Tutor')
            {

                $rules = [
                    'devolucion_tutor' => 'required',
                ];
            
                $customMessages = [
                    'required' => 'Recuerde que debe especificar al estudiante las correcciones necesarias'
                ];
                $this->validate($request, $rules, $customMessages);
                $formulario->devolucion_tutor = $request->devolucion_tutor;
                $formulario->estado = 'corregir';
                $formulario->save();

            }else
            if(auth()->user()->roles->pluck('name')->first() == 'Miembro CPPP'){
 
                $rules = [
                    'devolucion_miembrocpp' => 'required',
                ];
            
                $customMessages = [
                    'required' => 'Recuerde que debe especificar al estudiante las correcciones necesarias'
                ];
                $this->validate($request, $rules, $customMessages);
                $formulario->devolucion_miembro_cpp = $request->devolucion_miembrocpp;
                $formulario->estado = 'corregir';
                $formulario->save();

            }else
            if(auth()->user()->roles->pluck('name')->first() == 'Coordinador CPPP'){
                $rules = [
                    'devolucion_cpp' => 'required',
                ];
            
                $customMessages = [
                    'required' => 'Recuerde que debe especificar al estudiante las correcciones necesarias'
                ];
                $this->validate($request, $rules, $customMessages);
                $formulario->devolucion_cpp = $request->devolucion_cpp;
                $formulario->estado = 'corregir';
                $formulario->save();

            }
            else{
                return view('home');
            }

                
            return redirect()->route('formulario');
        }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Formulario  $formulario
     * @return \Illuminate\Http\Response
     */
    public function edit(Formulario $formulario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formulario  $formulario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Formulario $formulario)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formulario  $formulario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $formulario = Formulario::find($id); 
        $formulario->estado = 'rechazado';
        $formulario->save();
        return redirect()->route('formulario')->with('rechazado','ok');
    }

    //  *********
    //  ************ FUNCIONES PARA ACEPTAR FORMULARIOS EN CADA ETAPA DEL FORMULARIO  **********
    //  *********

    // FUNCION PARA ACEPTAR FORMULARIO POR PARTE DEL SUBDECANO
    public function aceptarFormulario($id)
    {
        // BUSQUEDA DE FORMULARIO
        $formulario = Formulario::find($id);
        // ID DEL ESTUDIANTE 
        $estudiante_id = $formulario->estudiante_id;
        // BUSQUEDA DEL ESTUDIANTE
        $estudiante = Estudiante::find($estudiante_id);
        $estudiante->name = $estudiante->nombres.' '.$estudiante->apellidos;

        $profesores = Profesor::all();
        $doc_soporte = Informacionsoporte::where('formulario_id',$formulario->id)->get(); 
        $doc_adicional = Informacionadicional::where('formulario_id',$formulario->id)->get();

        // return $profesores;

        return view('formulario.aceptar-formulario', [
            'formulario' => $formulario,
            'estudiante' => $estudiante,
            'profesores' => $profesores,
            'Doc_soporte' => $doc_soporte,
            'Doc_adicional' => $doc_adicional
        ]);
    }

    // FUNCION PARA ACEPTAR LOS NUEVOS FORMULARIOS POR PARTE DEL TURO
    public function aceptarFormularioTutor($id)
    {
        //
        $formulario = Formulario::find($id); 
        
        $estudiante_id = $formulario->estudiante_id;
        $estudiante = Estudiante::find($estudiante_id);

        $profesors_id = $formulario->profesors_id;
        $profesores = Profesor::find($profesors_id);

        $doc_soporte = Informacionsoporte::where('formulario_id',$formulario->id)->get(); 
        $doc_adicional = Informacionadicional::where('formulario_id',$formulario->id)->get();


        return view('formulario.aceptar-formulario-tutor', [
            'formulario' => $formulario,
            'estudiante' => $estudiante,
            'profesores' => $profesores,
            'Doc_soporte' => $doc_soporte,
            'Doc_adicional' => $doc_adicional
        ]);
    }


        // FUNCION PARA ACEPTAR FORMULARIOS POR MIEMBRO COMISION
        public function aceptarFormularioMiembrocpp($id)
        {
            //
            $formulario = Formulario::find($id); 
            
            $estudiante_id = $formulario->estudiante_id;
            $estudiante = Estudiante::find($estudiante_id);
    
            $profesors_id = $formulario->profesors_id;
            $profesores = Profesor::find($profesors_id);
    
            $doc_soporte = Informacionsoporte::where('formulario_id',$formulario->id)->get(); 
            $doc_adicional = Informacionadicional::where('formulario_id',$formulario->id)->get();
    
            return view('formulario.aceptar-formulario-miembrocomision', [
                'formulario' => $formulario,
                'estudiante' => $estudiante,
                'profesores' => $profesores,
                'Doc_soporte' => $doc_soporte,
                'Doc_adicional' => $doc_adicional
            ]);
        }

    // FUNCION PARA ACEPTAR FORMULARIOS POR LA COMISION
    public function aceptarFormularioComision($id)
    {
        //
        $formulario = Formulario::find($id); 
        
        $estudiante_id = $formulario->estudiante_id;
        $estudiante = Estudiante::find($estudiante_id);

        $profesors_id = $formulario->profesors_id;
        $profesores = Profesor::find($profesors_id);

        $doc_soporte = Informacionsoporte::where('formulario_id',$formulario->id)->get(); 
        $doc_adicional = Informacionadicional::where('formulario_id',$formulario->id)->get();

        return view('formulario.aceptar-formulario-comision', [
            'formulario' => $formulario,
            'estudiante' => $estudiante,
            'profesores' => $profesores,
            'Doc_soporte' => $doc_soporte,
            'Doc_adicional' => $doc_adicional
        ]);
    }

    // FUNCION PARA ACEPTAR FORMULARIOS POR EL DECANO
    public function aceptarFormularioDecano($id)
    {
        //
        $formulario = Formulario::find($id); 
        
        $estudiante_id = $formulario->estudiante_id;
        $estudiante = Estudiante::find($estudiante_id);

        $profesors_id = $formulario->profesors_id;
        $profesores = Profesor::find($profesors_id);

        $doc_soporte = Informacionsoporte::where('formulario_id',$formulario->id)->get(); 
        $doc_adicional = Informacionadicional::where('formulario_id',$formulario->id)->get();


        return view('formulario.aceptar-formulario-decano', [
            'formulario' => $formulario,
            'estudiante' => $estudiante,
            'profesores' => $profesores,
            'Doc_soporte' => $doc_soporte,
            'Doc_adicional' => $doc_adicional
        ]);
    }

    // Metodo para ceptar correcion por parte del estudiante
        // FUNCION PARA ACEPTAR FORMULARIO POR PARTE DEL SUBDECANO
        public function aceptarCorregir($id)
        {
            // BUSQUEDA DE FORMULARIO
            $formulario = Formulario::find($id);
            // ID DEL ESTUDIANTE 
            $estudiante_id = $formulario->estudiante_id;
            // BUSQUEDA DEL ESTUDIANTE
            $estudiante = Estudiante::find($estudiante_id);
            $estudiante->name = $estudiante->nombres.' '.$estudiante->apellidos;
    
         
            $doc_soporte = Informacionsoporte::where('formulario_id',$formulario->id)->get(); 
            $doc_adicional = Informacionadicional::where('formulario_id',$formulario->id)->get();
    
            // Determinar quien solicito la correccion:

            if($formulario->profesors_id == NULL && $formulario->firma_declaracion != NULL){

                $solicitante = 'Subdecano';
                $solicitud = $formulario->devolucion_subdecano;

            }elseif($formulario->profesors_id != NULL && $formulario->firma_tutor == NULL){

                $solicitante = 'Tutor';
                $solicitud = $formulario->devolucion_tutor;

            }elseif($formulario->recomendacion_miembro_cpp== NULL && $formulario->firma_tutor != NULL){

                $solicitante = 'Miembro de la CPP';
                $solicitud = $formulario->devolucion_miembro_cpp;

            }elseif($formulario->recomendacion_miembro_cpp != NULL && $formulario->firma_cpp == NULL){

                $solicitante = 'Coordinador de la CPP';
                $solicitud = $formulario->devolucion_cpp;

            }else{
                return view('home');
            }

            return view('formulario.aceptar-correcion-formulario', [
                'formulario' => $formulario,
                'estudiante' => $estudiante,
                'Doc_soporte' => $doc_soporte,
                'Doc_adicional' => $doc_adicional,
                'carrera' => $estudiante->carrera,
                'solicitante' => $solicitante,
                'solicitud' => $solicitud
            ]);
        }
    

        // Metodo para corregir formulario
        public function updateFormulario(Request $request)
        {
            
    
            $rules = [
                // 'actividad' => 'required',
                'cedula' => 'required|min:10|max:10',
                'correo' => 'required|min:6',
                'telefono' => 'required',
                'celular' => 'required',
                // 'documentacion_soporte' => 'required|max:5120',
                // 'ruc_institucion' => 'required',
                'razon_social_institucion' => 'required',
                'direccion_institucion' => 'required',
                'telefono_institucion' => 'required',
                'celular_institucion' => 'required',
                'ciudad_pais_institucion' => 'required',
                'tipo_institucion2' => 'required',
                'resumen_actividades' => 'required',
                'actividades_realizadas' => 'required',
                'aprendizaje_perfil' => 'required',
                'malla_curricular' => 'required',
                'fecha_inicio' => 'required|date',
                'fecha_fin' => 'required|date|after:fecha_inicio',
                'horas_solicitadas' => 'numeric|min:1',
                // 'firma_declaracion' => 'required|image|max:2048' 
            ];
        
            $customMessages = [
                'required' => 'El campo: :attribute es obligatorio.',
                'cedula.min' => 'El campo debe tener mínimo :min caracteres.',
                'horas_solicitadas.min' => 'Las horas solicitadas para convalidación deben ser mayor a :min hora.',
                'horas_solicitadas.numeric' => 'El campo solo acepta numeros.',
                'after' => 'La fecha de fin de actividades debe ser posterior a la fecha de inicio.',
                // 'firma_declaracion' => 'El campo firma de declaración solo acepta imagenes'
            ];
        
            $this->validate($request, $rules, $customMessages);
    
            $estudiante = Estudiante::find($request->id);       
            $estudiante->correo = $request->correo;
            $estudiante->telefono = $request->telefono;
            $estudiante->celular =$request->celular;
            $estudiante->save();
            
            
            $formulario = Formulario::find($request->formulario_id); 
            
            // $formulario->estudiante_id = (int) $estudiante->id; 
            $formulario->estado = "corregido"; 
            $formulario->resumen_actividades = $request->resumen_actividades; 
            $formulario->actividades_realizadas = $request->actividades_realizadas; 
            $formulario->aprendizaje_perfil = $request->aprendizaje_perfil; 
            $formulario->malla_curricular = $request->malla_curricular; 
            $formulario->fecha_inicio_actividades = $request->fecha_inicio; 
            $formulario->fecha_fin_actividades = $request->fecha_fin;
            $formulario->horas_solicitadas = (int) $request->horas_solicitadas; 
            // $formulario->fecha_declaracion = $request->fecha_declaracion; 
            $formulario->tipo_institucion = $request->tipo_institucion;
            $formulario->razon_social_institucion = $request->razon_social_institucion;
            if($request->ruc_institucion == ""){
                $formulario->ruc_institucion ="N/A";
            }else{
                $formulario->ruc_institucion = $request->ruc_institucion;
            }
            $formulario->direccion_institucion = $request->direccion_institucion;
            $formulario->telefono_institucion = $request->telefono_institucion;
            $formulario->celular_institucion = $request->celular_institucion;
            $formulario->ciudad_pais_institucion = $request->ciudad_pais_institucion;
            $formulario->correo_institucion = $request->correo_institucion; 
            $formulario->tipo_institucion2 = $request->tipo_institucion2; 
            $formulario->campo_amplio_institucion = $request->campo_amplio_institucion;
            $formulario->campo_especifico_institucion = $request->campo_especifico_institucion; 
            $formulario->codigo_proyecto_convenio = $request->codigo_proyecto_institucion;
            $formulario->nombre_proyecto_convenio = $request->nombre_proyecto_institucion;
            if($request->actividad == NULL){
                $formulario->actividades = $formulario->actividades;
            }else{
                $formulario->actividades = $request->actividad;
            }
            
            
            $formulario->save();
            
            //Crear Directorio de Documentacion de soporte adjunta
            $makeDirectory = Storage::makeDirectory('public/'.$request->epn.'/'.$formulario->id.'/informacion_de_soporte');
    
            if($makeDirectory){
                if($request->hasfile('documentacion_soporte')){
                    $misdoc = $request->file('documentacion_soporte'); 
                    foreach($misdoc as $file){
                        if(Storage::putFileAs('public/'.$request->epn.'/'.$formulario->id.'/informacion_de_soporte',$file,$file->getClientOriginalName())){
                            $Informacion_Soporte = new Informacionsoporte(); 
                            $Informacion_Soporte -> url_archivo = $file -> getClientOriginalName();
                            $Informacion_Soporte -> formulario_id = $formulario->id;
                            $Informacion_Soporte->save();
                        }                  
                      }
    
                }else{
                    echo "No se pudieron subir los documentos al servidor, por favor intente nuevamente.";
                } 
            }else{
                echo "No se pudo crear la carpeta para subir los documentos al servidor, por favor intente nuevamente.";
            }    
    
            //Crear Directorio de Informacion Adicional
            $makeDirectoryAdicional = Storage::makeDirectory('public/'.$request->epn.'/'.$formulario->id.'/informacion_adicional');
    
            if($makeDirectoryAdicional){
                if($request->hasfile('informacion_adicional')){                
                    $misdocAdicional = $request->file('informacion_adicional');                 
                    foreach($misdocAdicional as $file){
                        if(Storage::putFileAs('public/'.$request->epn.'/'.$formulario->id.'/informacion_adicional',$file,$file->getClientOriginalName())){
                            $Informacion_adicional = new Informacionadicional(); 
                            $Informacion_adicional -> url_archivo = $file -> getClientOriginalName();
                            $Informacion_adicional -> formulario_id = $formulario->id;
                            $Informacion_adicional->save();
                        }                  
                      }
                }
                else
                {
                    echo "No se pudieron subir los documentos al servidor, por favor intente nuevamente.";
                } 
            }
            else
            {
                echo "No se pudo crear la carpeta para subir los documentos al servidor, por favor intente nuevamente.";
            }   
            
            return redirect()->route('formulario')->with('enviado','ok');
            
        }
    
    

    // Metodo para revisar los formularios

    public function revisarFormulario($id)
    {
        //
        $formulario = Formulario::find($id); 
        $estudiante_id = $formulario->estudiante_id;
        $profesor_id = $formulario->profesors_id;
        $estudiante = Estudiante::find($estudiante_id);
        
        // Verificar si los datos ya fueron llenado o no
        
        // Verificar los datos del tutor
        if (isset($profesor_id)){
            $profesor = Profesor::find($profesor_id);
        }else{
            $profesor = new Profesor();
            $profesor -> nombres='                 El tutor aun no ha sido asignado';
            $profesor -> apellidos='';
            $profesor -> departamento=''; 
        }

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

        return view('formulario.revisar-formulario', [
            'formulario' => $formulario,
            'estudiante' => $estudiante,
            'profesor' => $profesor,
            'comision' => $comision,
            'decano' => $decano,
            'Doc_soporte' => $doc_soporte,
            'Doc_adicional' => $doc_adicional
            
        ]);
    }

}
