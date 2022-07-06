<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Estudiante;
use App\Models\EmpresaProyecto;
use App\Models\Registro;
use App\Models\Periodo;
use App\Models\TipoEmpresa;
use App\Models\Informe;
use App\Models\Encuesta;
use App\Models\TipoConvalidacion;
use App\Models\TipoPractica;
use App\Models\DatosConvalidacion;
use App\Models\DatosEmpresa;
use App\Models\DatosSeguimiento;
use PDF;

class ExtrasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('can:registros');
        //$this->middleware('can:registros.edit')->only('edit');
    }

    public function index()
    {
        
        $student = Estudiante::paginate(10);
        
        
        return view('registers.students', ['student'=>$student]);
    }

    public function show(Estudiante $var)
        {

            $periodo = Periodo::all();
            $tipo = TipoEmpresa::all();
            $informe = Informe::all();
            $encuesta = Encuesta::all();
            $convalidacion = TipoConvalidacion::all();
            $tipo_p = TipoPractica::all();

            $Estudiante = $var->epn;         

            $registro = Registro::whereHas('datosestudiante.estudiante', function($query) use($Estudiante){

                    if($Estudiante) {
                        return $query -> where('epn','LIKE',"%$Estudiante%");
                    }
                })
                ->paginate(1)
                ->appends(request()->query());

            

            return view('registers.index', ['periodo'=>$periodo, 'tipo'=>$tipo, 'informe'=>$informe, 'encuesta'=>$encuesta, 'tipo_p'=>$tipo_p, 'convalidacion'=>$convalidacion, 'registro'=>$registro]);

    }


}
