@extends('adminlte::page')

@section('title', 'Registros')

@section('content_header')
    <h1>Registros de Validación y Convalidación</h1>
@stop

@section('content')

    
    <form action="{{ route('registros.index') }}" method="get">
        <div class="row">
                    
            <div class="col-4"> 
                <input type="text" class="form-control" name="Estudiante" placeholder="Estudiante">              
            </div>

            <div class="col-4"> 
                <div class="card">                  
                <input type="text" class="form-control" name="Empresa_Proyecto" placeholder="Empresa/Proyecto">
                </div>
            </div>

            <div class="col-4"> 
                <div class="card"> 
                <input type="text" class="form-control" name="Tutor_FIEE" placeholder="Tutor FIEE">
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                <select class="form-control" name="tipo_e" id="tipo_e">
                    <option value="">Tipo de Empresa/Proyecto</option>
                    @foreach ($tipo as $item)
                    <option value="{{ $item->Tipo_Empresa }}">{{ $item->Tipo_Empresa }}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <select class="form-control" name="tipo_p" id="tipo_p">
                        <option value="" disabled selected>Tipo de Práctica</option>
                        @foreach ($tipo_p as $item)
                        <option value="{{ $item->TipoPracticas }}">{{ $item->TipoPracticas }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                <select class="form-control" name="tipo_c" id="tipo_c">
                    <option value="">Tipo de Convalidación</option>
                    @foreach ($convalidacion as $item)
                    <option value="{{ $item->Tipo_Convalidacion }}">{{ $item->Tipo_Convalidacion }}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                <select class="form-control" name="period" id="periodo">
                    <option value="">Periodo de validación</option>
                    @foreach ($periodo as $item)
                    <option value="{{ $item->Periodo }}">{{ $item->Periodo }}</option>
                    @endforeach
                </select>
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <select class="form-control" name="inf" id="inf">
                        <option value="" disabled selected>Informe</option>
                        @foreach ($informe as $item)
                        <option value="{{ $item->Informe }}">{{ $item->Informe }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            <div class="col-4">
                <div class="mb-3">
                <select class="form-control" name="enc" id="enc">
                    <option value="" disabled selected>Encuesta</option>
                    @foreach ($encuesta as $item)
                    <option value="{{ $item->Encuesta }}">{{ $item->Encuesta }}</option>
                    @endforeach
                </select>
                </div>
            </div>
        </div>

        <div class="row" align="center">

            <div class="col-6"> 
                <b>¿Se trata de un proceso de covalidación?:</b>
            </div>
            <div class="col-6">
                <b>Convenio entre la Institución y Empresa/Proyecto:</b>
            </div>
        </div>

        <div class="row" align="center">
            <div class="col-2"></div>
            <div class="col-1">
                <input type="radio" class="form-check-input" name="convl" id="convl_1" value="Sí">
                <label for="convl_1" class="form-check-label">Sí</label>
            </div>
                
            <div class="col-1">
                <input type="radio" class="form-check-input" name="convl" id="convl_2" value="No">
                <label for="convl_2" class="form-check-label">No</label>
            </div>              
            <div class="col-4"></div>
            <div class="col-1">
                <input type="radio" class="form-check-input" name="conv" id="conv_1" value="Sí">
                <label for="conv_1" class="form-check-label"> Sí</label>
            </div>

            <div class="col-1">
                <input type="radio" class="form-check-input" name="conv" id="conv_2" value="No">
                <label for="conv_2" class="form-check-label"> No</label>
            </div>
        </div><br>

        <div class="row">
            <div class="col-4">
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Filtrar</button>
            </div>
        </div><br>     
    </form>



@foreach($registro as $var)


@can('registros.edit')
    
<div class="row">
    

    <div class="col-12 col-lg-3">
            <div class="card">
                <td><a href="{{ route('registros.edit',$var) }}" class="btn btn-success">Editar</a></td>
            </div>
                
    </div>

    <div class="col-12 col-lg-6">
        
            <ul class="pagination justify-content-center">
                {{ $registro->links() }}
            </ul>  
        
    </div>

    <div class="col-12 col-lg-3">
        <div class="card">
            <a href="{{ route('download-pdf',$var->id) }}" class="btn btn-success">Generar PDF</a>
        </div>
            
    </div>

    
</div>

@endcan

<div class="card">



    <div class="card-header">
        <h5 class="card-title mb-0">DATOS GENERALES</h5><br>
        <div align="center"><b>{{ $var->datosestudiante->tipopractica->TipoPracticas}}</b></div><br>
        <table class="table table-bordered">

                <tr>
                    
                    <th style="width:40%">Estudiante:</th>
                    <th style="width:20%">Horas realizadas:</th>
                    <th style="width:20%">Inicio de Prácticas:</th>
                    <th style="width:20%">Fin de Prácticas:</th>
                </tr>

                <tr>
                    
                    <td style="text-align: center">{{ $var->datosestudiante->estudiante->nombres}} {{$var->datosestudiante->estudiante->apellidos }}</td>
                    <td style="text-align: center">{{ $var->datosestudiante->Horas }}</td>
                    <td style="text-align: center">{{ $var->datosestudiante->Inicio }}</td>
                    <td style="text-align: center">{{ $var->datosestudiante->Fin }}</td> 
                </tr>
        </table>

        <table class="table table-bordered">
                <tr>
                    <th style="width:40%">Tutor FIEE:</th>
                    <th style="width:20%">Informe de Seguimiento:</th>
                    <th style="width:20%">Encuesta:</th>
                    <th style="width:20%">Periodo:</th>
                </tr>

                <tr>
                    <td style="text-align: center">{{ $var->datosestudiante->tutor->Tutor_FIEE }}</td>
                    <td style="text-align: center">{{ $var->datosestudiante->informe->Informe }}</td>
                    <td style="text-align: center">{{ $var->datosestudiante->encuesta->Encuesta }}</td>
                    <td style="text-align: center">{{ $var->datosestudiante->periodo->Periodo }}</td>   
                </tr>
        </table>
    </div>
</div>

@if($var->datosempresa->empresaproyecto->Empresa_Proyecto)
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">EMPRESA/PROYECTO</h5><br>
        <table class="table table-bordered">
                <tr>
                    <th style="width:60%"></th>
                    <th style="width:20%">Convenio:</th>
                    <th style="width:20%">Tipo:</th>
                </tr>
                <tr>

                    <td style="text-align: center">{{ $var->datosempresa->empresaproyecto->Empresa_Proyecto }}</td>
                    <td style="text-align: center">{{ $var->datosempresa->convenio->Convenio }}</td>
                    <td style="text-align: center">{{ $var->datosempresa->tipoempresa->Tipo_Empresa }}</td>
                </tr>
        </table>

        <table class="table table-bordered">
                <tr>
                    <th style="width:30%">Tutor:</th>
                    <th style="width:30%">E-mail:</th>
                    <th style="width:20%">Teléfono:</th>
                    <th style="width:20%">Celular:</th>     
                </tr>
                <tr>
                    <td style="text-align: center">{{ $var->datosempresa->Tutor_EP }}</td>
                    <td style="text-align: center">{{ $var->datosempresa->E_Mail }}</td>
                    <td style="text-align: center">{{ $var->datosempresa->Telf }}</td>
                    <td style="text-align: center">{{ $var->datosempresa->Cel }}</td>
                </tr>
        </table>
    </div>
</div>
@endif

@if($var->datosconvalidacion->tipoconvalidacion->Tipo_Convalidacion != 'No')
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">CONVALIDACIÓN</h5><br>
        <table class="table table-bordered">
                <tr>

                    <th style="width:40%">Tipo de Convalidación:</th>
                    <th style="width:60%">Detalle de Convalidación:</th>
                </tr>
                <tr>
                    <td style="text-align: center">{{ $var->datosconvalidacion->tipoconvalidacion->Tipo_Convalidacion }}</td>
                    <td style="text-align: center">{{ $var->datosconvalidacion->Detalle }}</td>
                </tr>
        </table>
    </div>
</div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">SEGUIMIENTO</h5><br>
        <table class="table table-bordered">
    
                <tr>
                    <th style="width:25%">Fecha de Ingreso:</th>
                    <th style="width:25%">Fecha de Validación(CPPP):</th>
                    <th style="width:25%">Fecha de Certificado:</th>
                    <th style="width:25%">Fecha de Registro SAEw:</th>
                </tr>
                <tr>
                    <td style="text-align: center">{{ $var->datosseguimiento->Fecha_Ingreso }}</td>
                    <td style="text-align: center">{{ $var->datosseguimiento->Fecha_Val_CPPP }}</td>
                    <td style="text-align: center">{{ $var->datosseguimiento->Fecha_Cert }}</td>
                    <td style="text-align: center">{{ $var->datosseguimiento->Fecha_Reg_Sis }}</td>
                    
                </tr>
        </table>

        @if($var->datosseguimiento->Obs)

        <table class="table table-bordered">

            <tr align="center">
                <th>Observaciones</th>
            </tr>
            <tr>
                <td style="text-align: center">{{ $var->datosseguimiento->Obs }}</td>
            </tr>
        </table>
        @endif
    </div>
</div>



@endforeach

<ul class="pagination justify-content-center">
{{ $registro->links() }}
</ul>  
@stop

@section('css')
    <link rel="stylesheet" href="../css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop



