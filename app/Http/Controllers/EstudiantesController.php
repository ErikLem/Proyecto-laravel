<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;


class EstudiantesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => [
            'indexByEPN']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        if(auth()->user()->hasRole('admin'))
        {
            $estudiantes = Estudiante::all();
            return view('estudiante.index', ['estudiantes' => $estudiantes]);
            //return response()->json($estudiantes, 201);
        }else{
            return view('app');
        }

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexByEPN(Request $request)
    {
        //Consultado la API de estudiantes
        try {
            if($request->cookie('XSRF-TOKEN') != ""){
                $response = Http::post('http://127.0.0.1:8080/api/estudiantesEPN', [
                    'busqueda' => $request->busqueda,
                ]);

                $estudiante = new Estudiante();
                $estudiante->carrera = $response['carrera'];
                $estudiante->nombres = $response['nombres'];
                $estudiante->apellidos = $response['apellidos'];
                $estudiante->cedula = $response['cedula'];
                $estudiante->correo = $response['correo'];
                $estudiante->telefono = $response['telefono'];
                $estudiante->celular = $response['celular'];
                $estudiante->epn = $response['epn'];
                
                return view('estudiante.insert')->with('estudiantes', $estudiante);
            }
        } catch (\Throwable $th) {
            //echo $th;
            return redirect()->route('usuarios.create')->with('creado_estudiante','down');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        echo "Hola";
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        try {
                $rules = [
                    'cedula' => 'required|min:10|max:10',
                    'correo' => 'required|min:6',
                    'epn' => 'required|min:9',
                ];
            
                $customMessages = [
                    'required' => 'The :attribute field is required.'
                ];
            
                $this->validate($request, $rules, $customMessages);

                $password = bcrypt('password');

                // $paraUserName = Str::remove(' ', $request->nombres); // Elimina los espacios en blanco del nombre
                // $paraUserName = Str::limit($paraUserName, 12); //Limita a 12 caracteres el userName
                // $paraUserName = Str::remove('...', $paraUserName); //Eliminar los 3 puntos que crea la Str::limit
    
                $user = new User;
                $user->name = $request->nombres;
                $user->email = $request->correo;
                $user->username = $request->epn; // strtolower($paraUserName);
                $user->password = $password;
                $user->assignRole('Estudiante');

                $user->save();
               
                $estudiante = new Estudiante;
                $estudiante->cedula = $request->cedula;
                $estudiante->correo = $request->correo;
                $estudiante->epn = $request->epn;
        
                $estudiante->carrera = $request->carrera;
                $estudiante->nombres = $request->nombres;
                $estudiante->apellidos = $request->apellidos;
                $estudiante->telefono = $request->telefono;
                $estudiante->celular = $request->celular;   
                $estudiante->user_id = $user->id;
        
                $estudiante->save();            
    
                return redirect()->route('usuarios.index');
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json($th, 403);
            ///echo $th;
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $estudiante = Estudiante::find($id);
        $estudiante->delete();
        return redirect('/estudiantes');
    }
}
