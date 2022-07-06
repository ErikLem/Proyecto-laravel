<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use App\Models\Estudiante;
use PDF;

class FunctionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('can:usuarios');
    }

    public function downloadPdf($id)
    {
        $registro = Registro::find($id);
        $student = $registro->datosestudiante->estudiante->nombres.' '.$registro->datosestudiante->estudiante->apellidos;
        $data = [
            'id' => $registro->id,
            'Estudiante' => $student,
            'TipoPractica' => $registro->datosestudiante->tipopractica->TipoPracticas,
            'Horas' => $registro->datosestudiante->Horas,
            'Inicio' => $registro->datosestudiante->Inicio,
            'Fin' => $registro->datosestudiante->Fin,
            'Periodo' => $registro->datosestudiante->periodo->Periodo,

            'Tutor_FIEE' => $registro->datosestudiante->tutor->Tutor_FIEE,
            'Informe' => $registro->datosestudiante->informe->Informe,
            'Encuesta' => $registro->datosestudiante->encuesta->Encuesta,

            'Empresa_Proyecto' => $registro->datosempresa->empresaproyecto->Empresa_Proyecto,
            'Convenio' => $registro->datosempresa->convenio->Convenio,
            'Tipo_Empresa' => $registro->datosempresa->tipoempresa->Tipo_Empresa,

            'Tutor_EP' => $registro->datosempresa->Tutor_EP,
            'E_Mail' => $registro->datosempresa->E_Mail,
            'Telf' => $registro->datosempresa->Telf,
            'Cel' => $registro->datosempresa->Cel,

            'Convalidacion' => $registro->datosconvalidacion->convalidacion->Convalidacion,
            'Tipo_Convalidacion' => $registro->datosconvalidacion->tipoconvalidacion->Tipo_Convalidacion,
            'Detalle' => $registro->datosconvalidacion->Detalle,

            'Fecha_Ingreso' => $registro->datosseguimiento->Fecha_Ingreso,
            'Fecha_Val_CPPP' => $registro->datosseguimiento->Fecha_Val_CPPP,
            'Fecha_Cert' => $registro->datosseguimiento->Fecha_Cert,
            'Fecha_Reg_Sis' => $registro->datosseguimiento->Fecha_Reg_Sis,
            'Obs' => $registro->datosseguimiento->Obs,
            
        ];
        //return view('registers.pdf', $data);
        $pdf = PDF::loadView('registers.pdf', $data);
        return $pdf->stream(
            "{$registro->id} - {$registro->datosestudiante->estudiante->Estudiante}.pdf"
        );
    }
}
