@extends('adminlte::page')

@section('title', 'Formularios Recibidos')

@section('content_header')
    <h1>Formularios Recibidos</h1>
@stop

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    {{-- <link rel="stylesheet" href="../css/admin_custom.css"> --}}
@stop

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <!-- <link href="{{ asset('css/app.css') }}" type="text/css" rel="stylesheet"> -->

    
    <style>
        
        body{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }
        .color-container{
            width: 16px;
            height: 16px;
            display: inline-block;
            border-radius: 4px;
        }
        a{
            text-decoration: none;
        }
        span{
            font-weight: bold;
        }
        
        
        @media (min-width: 992px){
        .navbar-expand-lg .navbar-collapse{
            display: flex!important;
            flex-basis: auto;
            justify-content: flex-end;
        }}

        .btn-outline-dark {
            margin-left: 10px;
        }        
    </style>
</head>

@section('content')     
    
<div class="card mx-4 mb-4">
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    
            <div class="card-header">
                <h2>Aceptar Formulario CPP</h2>
            </div>
            <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne">
                    Carrera
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" >
                <div class="accordion-body">
                    <input type="text" class="form-control" id="carrera" name="carrera" value="{{ $estudiante->carrera }}" readonly="readonly">
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    1- Actividades para las que solicita la convalidación
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" >
                <div class="accordion-body">
                        <label class="form-check-label" for="flexRadioDefault1">
                            {{$formulario->actividades}}
                        </label>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    2- Datos del estudiante
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" >
                <div class="accordion-body">
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" id="id" name="id" value="{{ $estudiante->id }}" readonly="readonly">
                    </div>
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" id="epn" name="epn" value="{{ $estudiante->epn }}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="nombres" class="form-label">Nombres y Apellidos</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $estudiante->nombres }} {{ $estudiante->apellidos }}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="cedula" class="form-label">C&eacute;dula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $estudiante->cedula }}" readonly="readonly">
                    </div>            
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" aria-describedby="emailHelp" value="{{ $estudiante->correo }}" readonly="readonly">
                        @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Tel&eacute;fono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ $estudiante->telefono }}" readonly="readonly">
                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" class="form-control @error('celular') is-invalid @enderror" id="celular" name="celular" value="{{ $estudiante->celular }}" readonly="readonly">
                        @error('celular')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>  
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    3- Documentación de soporte adjunta
                </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" >
                    <div class="accordion-body">
                        {{-- INFORMACION DE SOPORTE ADJUNTADA --}}

                <div class="container border p-4 mt-4">    
                    <table class="table">
                        <tr>
                            <th>Nombre del archivo</th>
                            <th>Descargar archivo </th>
                        </tr>
                        @foreach ($Doc_soporte as $doc_soporte)    
                            <tr>

                                <td>{{$doc_soporte->url_archivo}} </td>
                                <td><a href="http://cppp.test/storage/{{$estudiante->epn}}/{{$formulario->id}}/informacion_de_soporte/{{$doc_soporte->url_archivo}}" class="btn btn-sm btn-outline-secondary" download="{{$doc_soporte->url_archivo}}"> Descargar </a> </td>
    
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    4- Información de la institución en la que realizó las actividades
                </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" >
                <div class="accordion-body">
                    <div class="form-check mt-4 mb-4">
                        <div class="">
                            <label class="form-check-label" for="institucion_nacional">
                                Tipo Institución: <span>{{$formulario->tipo_institucion}}</span>
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="ruc_institucion" class="form-label">RUC *:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="ruc_institucion" name="ruc_institucion" value="{{$formulario->ruc_institucion}}" readonly="readonly">
                        </div>    
                    </div>
                    <div class="mb-3">
                        <label for="razon_social_institucion" class="form-label">Razón Social *:</label>
                        <input type="text" class="form-control" id="razon_social_institucion" name="razon_social_institucion" value="{{$formulario->razon_social_institucion}}" readonly="readonly">
                    </div>                   
                    <div class="mb-3">
                        <label for="direccion_institucion" class="form-label">Dirección *:</label>
                        <input type="text" class="form-control" id="direccion_institucion" name="direccion_institucion" value="{{$formulario->direccion_institucion}}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="telefono_institucion" class="form-label">Teléfono *:</label>
                        <input type="text" class="form-control" id="telefono_institucion" name="telefono_institucion" value="{{$formulario->telefono_institucion}}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="celular_institucion" class="form-label">Celular *:</label>
                        <input type="text" class="form-control" id="celular_institucion" name="celular_institucion" value="{{$formulario->celular_institucion}}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="ciudad_pais_institucion" class="form-label">Ciudad/Pais *:</label>
                        <input type="text" class="form-control" id="ciudad_pais_institucion" name="ciudad_pais_institucion" value="{{$formulario->ciudad_pais_institucion}}" readonly="readonly"/>
                    </div>
                    <div class="mb-3">
                        <label for="correo_institucion" class="form-label">Correo *:</label>
                        <input type="text" class="form-control" id="correo_institucion" name="correo_institucion" value="{{$formulario->correo_institucion}}" readonly="readonly"/>
                    </div>
                    <div class="mb-3">
                        <label for="tipo_institucion" class="form-label">Tipo de institución: {{$formulario->tipo_institucion2}}</label>
                    </div>
                    <div class="mb-3">
                        <label for="campo_amplio_institucion" class="form-label">Campo Amplio:</label>
                        <input type="text" class="form-control" id="campo_amplio_institucion" name="campo_amplio_institucion" value="{{$formulario->campo_amplio_institucion}}" readonly="readonly"/>
                    </div>
                    <div class="mb-3">
                        <label for="campo_especifico_institucion" class="form-label">Campo Específico:</label>
                        <input type="text" class="form-control" id="campo_especifico_institucion" name="campo_especifico_institucion" value="{{$formulario->campo_especifico_institucion}}" readonly="readonly"/>
                    </div>
                    <div class="mb-3">
                        <label for="codigo_proyecto_institucion" class="form-label">Código Proyecto/Convenio **:</label>
                        <input type="text" class="form-control" id="codigo_proyecto_institucion" name="codigo_proyecto_institucion" value="{{$formulario->codigo_proyecto_convenio}}" readonly="readonly"/>
                    </div>
                    <div class="mb-3">
                        <label for="nombre_proyecto_institucion" class="form-label">Nombre del Proyecto/Convenio:</label>
                        <input type="text" class="form-control" id="nombre_proyecto_institucion" name="nombre_proyecto_institucion" value="{{$formulario->nombre_proyecto_convenio}}" readonly="readonly"/>
                    </div>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    5- Información de las actividades realizadas
                </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" >
                <div class="accordion-body">
                    <div class="mb-3">
                        <label for="resumen_actividades" class="form-label">Breve resumen de las actividades realizadas:</label>
                        <textarea class="form-control" id="resumen_actividades" name="resumen_actividades" rows="2" readonly="readonly">{{$formulario->resumen_actividades}}</textarea>
                    </div>            
                    <div class="mb-3">
                        <label for="actividades_realizadas" class="form-label">¿De qué manera las actividades realizadas contribuyeron al perfil de egreso de su carrera?</label>
                        <textarea class="form-control" id="actividades_realizadas" name="actividades_realizadas" rows="2" readonly="readonly">{{$formulario->actividades_realizadas}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="aprendizaje_perfil" class="form-label">¿A qué resultados de aprendizaje del perfil de egreso considera que aportaron las actividades realizadas?</label>
                        <textarea class="form-control" id="aprendizaje_perfil" name="aprendizaje_perfil" rows="2" readonly="readonly">{{$formulario->aprendizaje_perfil}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="malla_curricular" class="form-label">¿Cuáles son las asignaturas de la malla curricular y las temáticas de mayor utilidad para el desarrollo de las actividades?</label>
                        <textarea class="form-control" id="malla_curricular" name="malla_curricular" rows="2" readonly="readonly">{{$formulario->malla_curricular}}</textarea>                        
                    </div>  
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    6- Información Adicional
                </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" >
                <div class="accordion-body">
                    <div class="mb-3">
                        <label for="nombres" class="form-label">Información de las fechas en las que realizó las actividades</label>
                    </div>
                    <div class="d-flex gap-2 justify-content-around">
                        <div class="mb-3 flex-fill">
                            <label for="fecha_inicio" class="form-label">Fecha Inicio: </label>
                            <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" name="fecha_inicio" value="{{$formulario->fecha_inicio_actividades}}" readonly="readonly">
                            @error('fecha_inicio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 flex-fill">
                            <label for="fecha_fin" class="form-label">Fecha Fin: </label>
                            <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin" name="fecha_fin" value="{{$formulario->fecha_fin_actividades}}" readonly="readonly"/>
                            @error('fecha_fin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>                    
                    <div class="mb-3">
                        <label for="horas_solicitadas" class="form-label">Horas Solicitadas: </label>
                        <input type="number" class="form-control" id="horas_solicitadas" name="horas_solicitadas" value="{{$formulario->horas_solicitadas}}" readonly="readonly"/>
                    </div>
                    
                       {{-- DOCUMENTACIÓN ADICIONAL --}}
                       <div class="container border p-4 mt-4">    
                        <table class="table">
                            <tr>
                                <th>Nombre del archivo</th>
                                <th>Descargar archivo </th>
                            </tr>
                            @foreach ($Doc_adicional as $doc_adicional)    
                                <tr>
    
                                    <td>{{$doc_adicional->url_archivo}} </td>
                                    <td><a href="http://cppp.test/storage/{{$estudiante->epn}}/{{$formulario->id}}/informacion_adicional/{{$doc_adicional->url_archivo}}" class="btn btn-sm btn-outline-secondary" download="{{$doc_adicional->url_archivo}}">Descargar</a> </td>
        
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    7- Declaración
                </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" >
                <div class="accordion-body">
                    <div class="mb-3">
                        <p class="form-label">Yo, {{$estudiante->nombres}} {{$estudiante->apellidos}}, declaro que la información presentada para la convalidación de prácticas preprofesionales es verídica</p>
                        <label for="fecha_declaracion" class="form-label">Fecha: {!! date('d/m/Y', strtotime($formulario->fecha_declaracion)) !!}</label>
                    </div>
                    <div class="mb-3">
                        <label for="firma_declaracion" class="form-label">Firma: </label>
                        <img style="max-width:15%;width:auto;height:auto;" src="{{asset($formulario->firma_declaracion)}}" alt="">
                    </div>
                </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                    8- Informe del tutor EPN
                </button>
                </h2>
                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" >
                <div class="accordion-body">
                    <div class="mb-3">
                        <label for="nombre_tutor" class="form-label">Nombre: </label>
                        <input type="text" class="form-control" name="nombre_tutor" id="nombre_tutor" value="{{$profesores->nombres}} {{$profesores->apellidos}}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="departamento_tutor" class="form-label">Departamento: </label>
                        <input type="text" class="form-control" name="departamento_tutor" id="departamento_tutor" value="{{$profesores->departamento}}" readonly="readonly">
                    </div>
                    <div>
                        <label class="form-label">
                            ¿Considera que las actividades reportadas contribuyeron a la aplicación de 
                            conocimientos o al desarrollo de competencias en la formación del estudiante?
                        </label>
                        <br>
                        <label>{{$formulario->inf_tutor_Q1 == 'Si' ? 'SI' : 'NO'}}</label>
                        <br>
                    </div>
                    <div>
                        <label class="form-label">
                            ¿Considera que las actividades reportadas contribuyeron a la consecución de 
                            los resultados del aprendizaje del perfil de egreso? 
                        </label>
                        <br>
                        <label>{{$formulario->inf_tutor_Q2 == 'Si' ? 'SI' : 'NO'}}</label>
                        <br>
                    </div>
                    <div>
                        <label class="form-label">
                            ¿Validó las actividades reportadas por el estudiante?
                        </label>
                        <br>
                        <label>{{$formulario->inf_tutor_Q3 == 'Si' ? 'SI' : 'NO'}}</label>
                        <br>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Análisis y Recomendaciones respecto de la información presentada:
                        </label>
                        <textarea class="form-control" name="analisis_recomendaciones_tutor" rows="2" readonly="readonly"> {{$formulario->recomendaciones_tutor}}
                        </textarea>
                    </div>
                    <div>
                        <label class="form-label">
                            Horas validadas y sugeridas de convalidación:
                        </label>
                        <input type="text" class="form-control" id="horas_validadas_tutor" name="horas_validadas_tutor" value="{{$formulario->horas_sugeridas}}" readonly="readonly"/>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_revision_tutor" class="form-label">Fecha de revision: </label>
                        <input type="date" class="form-control" name="fecha_revision_tutor" id="revision_tutor" value="{{$formulario->fecha_revision_tutor}}" readonly="readonly"/>
                    </div>
                    <div class="mb-3">
                        <label for="firma_declaracion" class="form-label">Firma: </label>
                        <img style="max-width:15%;width:auto;height:auto;" src="{{asset($formulario->firma_tutor)}}" alt="">
                    </div>
                </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTen">
                <button class="accordion-button collapsed" type="button" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#collapseTen" aria-controls="collapseTen">
                    9.- Miembro de la Comision de prácticas preprofesionales
                </button>
                </h2>
                <div id="collapseTen" class="accordion-collapse collapse" aria-labelledby="headingTen" >
                <div class="accordion-body">

                    <label class="form-label">
                        Recomendación por miembro de la CPP:
                    </label>
    
                    <textarea class="form-control" name="recomendacion_miembro_cpp" readonly="readonly">{{$formulario->recomendacion_miembro_cpp}}</textarea>
                   {{-- AQUI SE DEBE ENVIAR LA FECHA DE REVISION POR EL MIEMBRO DE LA CPP --}}
                    {{-- <div class="mb-3">
                        <label for="fecha_revision_comision" class="form-label">Fecha de revision: </label>
                        <input type="date" class="form-control" name="fecha_revision_comision" id="revision_comision" value="" readonly="readonly"/>
                    </div> --}}
                    {{-- Envio de Id del formulario por hidden --}}
                    <input type="text" class="form-control" name="formulario_id" id="formulario_id" value="{{ $formulario->id }}" hidden> 
                </div>

                </div>
                </div>
            </div>

     <form action="{{ route('formulario.insert.comision') }}" method="POST" class="formulario-enviar" enctype="multipart/form-data">
         @csrf
         @method('put')
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEleven">
                <button class="accordion-button collapsed" type="button" aria-expanded="true" data-bs-toggle="collapse" data-bs-target="#collapseEleven" aria-controls="collapseEleven">
                    10- Comision de prácticas preprofesionales
                </button>
                </h2>
                <div id="collapseEleven" class="accordion-collapse collapse" aria-labelledby="headingEleven" >
                <div class="accordion-body">

                    <div class="mb-3">
                        <label for="horas_convalidadas" class="form-label">Horas convalidadas: </label>
                        <input type="number" class="form-control" id="horas_convalidas" name="horas_convalidadas" value="{{old('horas_convalidadas')}}" >
                    </div>
                    <div class="d-flex gap-2 justify-content-around">
                        <div class="mb-3 flex-fill">
                            <label for="horas_convalidadas_practicas" class="form-label">Prácticas Laborales: </label>
                            <input type="number" class="form-control" id="horas_convalidadas_practicas" name="horas_convalidadas_practicas" value="{{old('horas_convalidadas_practicas')}}" >
                        </div>
                        <div class="mb-3 flex-fill">
                            <label for="horas_convalidads_comunitario" class="form-label">Servicio Comunitario: </label>
                            <input type="number" class="form-control" id="horas_convalidadas_comunitario" name="horas_convalidadas_comunitario" value="" readonly="readonly" >
                        </div>
                    </div>                    
                    <label class="form-label">
                        Observaciones de la CPP:
                    </label>
                    <textarea class="form-control" name="observaciones_cpp">{{old('observaciones_cpp')}}</textarea>
                    <br>
                    <div class="mb-3">
                        <label for="firma_comision" class="form-label">Firma: </label>
                        <input type="file" class="form-control" name="firma_comision" id="firma_comision" accept="image/*">
                    </div>
                    <div class="mb-3">
                        <label for="fecha_revision_comision" class="form-label">Fecha de revision: </label>
                        <input type="date" class="form-control" name="fecha_revision_comision" id="revision_comision" value="<?php echo date("Y-m-d");?>" readonly="readonly"/>
                    </div>
                    {{-- Envio de Id del formulario por hidden --}}
                    <input type="text" class="form-control" name="formulario_id" id="formulario_id" value="{{ $formulario->id }}" hidden> 
                </div>

                </div>
                </div>
            </div>

            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">Aceptar Formulario</button>
            </div>            
    </form>

                  {{-- BOTON PARA PEDIR CORRECCION --}}
            
                  <div class="accordion-item">
                    <form action="{{ route('formulario.corregir') }}" method="POST" class="formulario-corregir">
                        @method('put')
                        @csrf
                    <h2 class="accordion-header" id="headingTwelve">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwelve" aria-expanded="true" aria-controls="collapseTwelve">
                        ***************** SOLICITAR CORRECIONES *****************
                    </button>
                    </h2>
                    <div id="collapseTwelve" class="accordion-collapse collapse" aria-labelledby="headingTwelve" >
                    <div class="accordion-body">
                        <div class="mb-3">
                            <div class="alert alert-warning">En esta sección puede solicitar al estudiante correciones, o a su vez documentos adicionales</div>
                            <input type="text" class="form-control" name="formulario_id" id="formulario_id" value="{{ $formulario->id }}" hidden>
                            <textarea class="form-control" id="devolucion_cpp" name="devolucion_cpp" rows="4">{{old('devolucion_subdecano')}}</textarea>
                        </div>
                        <button class="btn btn-primary" style="background-color:ORANGE" > Solicitar correciones </button>
                    </div>
                    </div>
                         
                
                 </form> 
                </div>
    {{-- BOTON PARA RECHAZAR FORMULARIO --}}
    <div class="card-footer text-muted">
        <form action="{{route('formulario.destroy', $formulario->id)}}" class="formulario-rechazar" method="POST">
            @method('DELETE')
            @csrf
            <button class="btn btn-primary" style="background-color:red" > Rechazar formulario </button>     
            
        </form> 
    </div> 
    
</div>

@stop



@section('js')
    <script> console.log('Hi!'); </script>
    
    <script>
        let precio1 = document.getElementById("horas_convalidas")
        let precio2 = document.getElementById("horas_convalidadas_practicas")
        let precio3 = document.getElementById("horas_convalidadas_comunitario")
        
        precio2.addEventListener("change", () => {
            precio3.value = parseFloat(precio1.value) - parseFloat(precio2.value)
    
        })
        
    </script>



        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <script>

            $('.formulario-enviar').submit(function(e){
                e.preventDefault();
            Swal.fire({
            title: 'Esta seguro que quiere enviar el formulario?',
            text: "Asegurese que la información ingresada es correcta",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, enviar formulario!',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
            if (result.isConfirmed) {

                this.submit();
            }
            })
            });
            
        </script>
        {{-- Script para confirmar si se quiere rechazar un formulario --}}
        <script>

            $('.formulario-rechazar').submit(function(e){
                e.preventDefault();
            Swal.fire({
            title: 'Esta seguro que quiere recharzar este formulario?',
            text: "Recuerde que esta acción no se podra modificar",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, rechazar formulario!',
            cancelButtonText: 'Cancelar',
            }).then((result) => {
            if (result.isConfirmed) {

                this.submit();
            }
            })
            });
            
        </script>
@stop