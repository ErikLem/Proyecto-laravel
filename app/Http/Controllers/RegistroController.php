<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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

class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:registros');
        $this->middleware('can:registros.edit')->only('edit');
    }

    public function index(Request $request)
        {

            $periodo = Periodo::all();
            $tipo = TipoEmpresa::all();
            $informe = Informe::all();
            $encuesta = Encuesta::all();
            $convalidacion = TipoConvalidacion::all();
            $tipo_p = TipoPractica::all();

            $Estudiante = $request->get('Estudiante');

            $Empresa = $request->get('Empresa_Proyecto');
            $Tutor = $request->get('Tutor_FIEE');
            $Tutor_E = $request->get('Tutor_Empresa');
            $Convl = $request->get('convl');
            $Conv = $request->get('conv');
            $Perd = $request->get('period');
            $Tipo_E = $request->get('tipo_e');
            $Tipo_C = $request->get('tipo_c');
            $Inf = $request->get('inf');
            $Enc = $request->get('enc');
            $Tipo_p = $request->get('tipo_p');
            

            $registro = Registro::whereHas('datosestudiante.estudiante', function($query) use($Estudiante){

                    if($Estudiante) {
                        return $query -> where('nombres','LIKE',"%$Estudiante%")
                        ->orWhere('apellidos','LIKE',"%$Estudiante%");
                    }
                })
                ->whereHas('datosempresa.empresaproyecto', function($query) use($Empresa){

                    if($Empresa) {
                        return $query -> where('Empresa_Proyecto','LIKE',"%$Empresa%");
                    }
                })
                ->whereHas('datosestudiante.tutor', function($query) use($Tutor){

                    if($Tutor) {
                        return $query -> where('Tutor_FIEE','LIKE',"%$Tutor%");
                    }
                })
                ->whereHas('datosempresa', function($query) use($Tutor_E){

                    if($Tutor_E) {
                        return $query -> where('Tutor_EP','LIKE',"%$Tutor_E%");
                    }
                })
                ->whereHas('datosconvalidacion.convalidacion', function($query) use($Convl){

                    if($Convl) {
                        return $query -> where('Convalidacion','LIKE',"%$Convl%");
                    }
                })
                ->whereHas('datosempresa.convenio', function($query) use($Conv){

                    if($Conv) {
                        return $query -> where('Convenio','LIKE',"%$Conv%");
                    }
                })
                ->whereHas('datosestudiante.periodo', function($query) use($Perd){

                    if($Perd) {
                        return $query -> where('Periodo','LIKE',"%$Perd%");
                    }
                })
                ->whereHas('datosestudiante.informe', function($query) use($Inf){

                    if($Inf) {
                        return $query -> where('Informe','LIKE',"%$Inf%");
                    }
                })
                ->whereHas('datosestudiante.encuesta', function($query) use($Enc){

                    if($Enc) {
                        return $query -> where('Encuesta','LIKE',"%$Enc");
                    }
                })
                ->whereHas('datosestudiante.tipopractica', function($query) use($Tipo_p){

                    if($Tipo_p) {
                        return $query -> where('TipoPracticas','LIKE',"%$Tipo_p");
                    }
                })
                ->whereHas('datosempresa.tipoempresa', function($query) use($Tipo_E){

                    if($Tipo_E) {
                        return $query -> where('Tipo_Empresa','LIKE',"$Tipo_E");
                    }
                })
                ->whereHas('datosconvalidacion.tipoconvalidacion', function($query) use($Tipo_C){

                    if($Tipo_C) {
                        return $query -> where('Tipo_Convalidacion','LIKE',"%$Tipo_C%");
                    }
                })
                ->paginate(1)
                ->appends(request()->query());

            

            return view('registers.index', ['periodo'=>$periodo, 'tipo'=>$tipo, 'informe'=>$informe, 'encuesta'=>$encuesta, 'tipo_p'=>$tipo_p, 'convalidacion'=>$convalidacion, 'registro'=>$registro]);

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
    public function edit(Registro $registro)
    {

        return view('registers.edit',compact('registro'));
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

        $dconvalidacion = DatosConvalidacion::find($id);

        if($request->detail != null){
            $dconvalidacion->Detalle = $request->detail;
        }
        $dconvalidacion->save();

        $dempresa = DatosEmpresa::find($id);


        if($request->Tutor_EP != null){
            $dempresa->Tutor_EP = $request->Tutor_EP;
        }
        if($request->email != null){
            $dempresa->E_Mail = $request->email;
        }
        if($request->telf != null){
            $dempresa->Telf = $request->telf;
        }
        if($request->cel != null){
            $dempresa->Cel = $request->cel;
        }
        
        $dempresa->save();

        $dseguimiento = DatosSeguimiento::find($id);
        if($request->ing != null){
            $dseguimiento->Fecha_Ingreso = $request->ing;
        }
        if($request->val != null){
            $dseguimiento->Fecha_Val_CPPP = $request->val;
        }
        if($request->cert != null){
            $dseguimiento->Fecha_Cert = $request->cert;
        }
        if($request->sis != null){
            $dseguimiento->Fecha_Reg_Sis = $request->sis;
        }
        $dseguimiento->save();

        $registro = Registro::find($id);

        return redirect()->route('registros.edit', $registro)->with('Info','Succes! Data updated successfully');
        //return redirect()->route('registros.edit',compact('registro'));

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
    }
}
