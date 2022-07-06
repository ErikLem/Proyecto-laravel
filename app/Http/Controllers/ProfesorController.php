<?php

namespace App\Http\Controllers;

use App\Models\Profesor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ProfesorController extends Controller
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
            $profesores = Profesor::all();
            return view('profesor.index', ['profesores' => $profesores]);
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
        //Consultando a la API para Seleccionar el profesor dado un EPN
        try {
            if($request->cookie('XSRF-TOKEN') != ""){
                $response = Http::post('http://127.0.0.1:8080/api/profesoresEPN', [
                    'busqueda' => $request->busqueda,
                ]);
                $profesor = new Profesor();
                $profesor->departamento = $response['departamento'];
                $profesor->nombres = $response['nombres'];
                $profesor->apellidos = $response['apellidos'];
                $profesor->cedula = $response['cedula'];
                $profesor->correo = $response['correo'];
                $profesor->telefono = $response['telefono'];
                $profesor->celular = $response['celular'];
                $profesor->epn = $response['epn'];
                
                return view('profesor.insert')->with('profesor', $profesor);
                //return response()->json(json_decode($response), 201); 
            }
        } catch (\Throwable $th) {
            //echo $th;
            return redirect()->route('usuarios.create')->with('creado_profesor','down');
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
            $request->validate([
                'cedula' => 'required|min:10|max:10',
                'correo' => 'required|min:6',
                'epn' => 'required|min:9'
            ]);

            $password = bcrypt('password');

            // $paraUserName = Str::remove(' ', $request->nombres); // Elimina los espacios en blanco del nombre
            // $paraUserName = Str::limit($paraUserName, 12); //Limita a 12 caracteres el userName
            // $paraUserName = Str::remove('...', $paraUserName); //Eliminar los 3 puntos que crea la Str::limit

            $user = new User;
            $user->name = $request->nombres;
            $user->email = $request->correo;
            $user->username = $request->epn; //strtolower($paraUserName);
            $user->password = $password;
            $user->assignRole('Tutor');

            $user->save();
           
            $profesor = new Profesor;
            $profesor->cedula = $request->cedula;
            $profesor->correo = $request->correo;
            $profesor->epn = $request->epn;
    
            $profesor->departamento = $request->departamento;
            $profesor->nombres = $request->nombres;
            $profesor->apellidos = $request->apellidos;
            $profesor->telefono = $request->telefono;
            $profesor->celular = $request->celular;      
            $profesor->user_id = $user->id;   
    
            $profesor->save();

            return redirect()->route('usuarios.index');
        } catch (\Throwable $th) {
            //throw $th;
            echo $th;
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function show(Profesor $profesor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function edit(Profesor $profesor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profesor $profesor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profesor  $profesor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profesor $profesor, $id)
    {
        //
        $estudiante = Profesor::find($id);
        dd($estudiante);
        //$estudiante->delete();
        //return redirect('/profesores');
    }
}
