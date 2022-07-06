
@extends('adminlte::page')

@section('title', 'Formulario corregir')

@section('content_header')
    <h1>Formulario para corregir</h1>
@stop

@section('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
    {{-- <link rel="stylesheet" href="../css/admin_custom.css"> --}}
@stop

@section('content')     

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
    
<form action="{{ route('formulario.updateformulario') }}" method="POST" class="formulario-enviar" enctype="multipart/form-data">
    @method('put')
    @csrf
    
    <div class="alert alert-danger">El {{$solicitante}} Solicita que se realicen las siguientes correcciones para continuar con el proceso: </div>
    <div class="alert alert-danger">{{$solicitud}}</div>
    <div class="alert alert-danger"><strong>!!IMPORNTANTE!!</strong><br>Todos los campos del formulario se encuentran habilitados y pueden ser modificados, por lo tanto procure no realizar modificaciones en los campos que no se requieren, porque esto puede alterar la informacion que ya fue enviada anteriormente. <br> <strong>Modifique únicamnete los campos que le han solicitado</strong></div>
    

     
    
            <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-controls="collapseOne">
                    Carrera
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne">
                <div class="accordion-body">
                    <input type="text" class="form-control" id="carrera" name="carrera" value="{{ $estudiante->carrera }}" readonly="readonly">
                </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    1- Actividades para las que solicita la convalidación
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
                <div class="accordion-body">
                        <label class="form-check-label" for="flexRadioDefault1">
                            <br>
                            <strong>Actividad anterior: {{$formulario->actividades}}</strong> 
                        </label>
                </div>
                {{-- Añadir radio buttons --}}
                <div class="accordion-body">
                    
                    <div class="alert alert-warning">Seleccione una nueva actividad solo si le fue solicitado</div>
                    
                    <div class="form-check">
                        <!-- <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Cursos y Seminarios Profesionales"> -->
                        <input class="form-check-input" type="radio" name="actividad" value="Cursos y Seminarios Profesionales" {{ (old('actividad') == "Cursos y Seminarios Profesionales") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Cursos y Seminarios Profesionales
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Participación Estudiantil en Actividades Académicas, de Gestión, de Investigación y de Colaboración en Eventos Académicos **" {{ (old('actividad') == "Participación Estudiantil en Actividades Académicas, de Gestión, de Investigación y de Colaboración en Eventos Académicos **") ? "checked" : ""}}>
                        <label class="form-check-label">
                            Participación Estudiantil en Actividades Académicas, de Gestión, de Investigación y de Colaboración en Eventos Académicos **
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Represantación Estudiantil" {{ (old('actividad') == "Represantación Estudiantil") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Represantación Estudiantil
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Estudiantes Mentores" {{ (old('actividad') == "Estudiantes Mentores") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Estudiantes Mentores
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Actividades solidarias y de cooperación" {{ (old('actividad') == "Actividades solidarias y de cooperación") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Actividades solidarias y de cooperación
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Actividades solidarias y de cooperación" {{ (old('actividad') == "Actividades solidarias y de cooperación") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Actividades solidarias y de cooperación
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Experiencia Laboral" {{ (old('actividad') == "Experiencia Laboral") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Experiencia Laboral
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Idiomas diferenctes al Inglés y Lengua Materna" {{ (old('actividad') == "Idiomas diferenctes al Inglés y Lengua Materna") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Idiomas diferenctes al Inglés y Lengua Materna
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Dirección de ramas de organizaciones estudiantiles académicas" {{ (old('actividad') == "Dirección de ramas de organizaciones estudiantiles académicas") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Dirección de ramas de organizaciones estudiantiles académicas
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Representación de la Institución en competencias académicas" {{ (old('actividad') == "Representación de la Institución en competencias académicas") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Representación de la Institución en competencias académicas
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Coro y Grupo de Cámara" {{ (old('actividad') == "Coro y Grupo de Cámara") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Coro y Grupo de Cámara
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Participación en la dirección de asociaciones de estudiantes" {{ (old('actividad') == "Participación en la dirección de asociaciones de estudiantes") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Participación en la dirección de asociaciones de estudiantes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Participación en juntas receptoras del voto" {{ (old('actividad') == "Participación en juntas receptoras del voto") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Participación en juntas receptoras del voto
                        </label>
                    </div>
                        @error('actividad')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
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
                        <input type="email" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" aria-describedby="emailHelp" value="{{ $estudiante->correo }}">
                        @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Tel&eacute;fono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ $estudiante->telefono }}">
                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" class="form-control @error('celular') is-invalid @enderror" id="celular" name="celular" value="{{ $estudiante->celular }}">
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
                    Documentos subidos anteriormente:
                </div>

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

                <div class="container border p-4 mt-4">  
                    Nuevos documentos de soporte:
                </div>
                <div class="container border p-4 mt-4">  
                    <div class="alert alert-warning">Aqui puede cargar nuevos documentos de soporte</div>
                </div>
                <div class="container border p-4 mt-4"> 
                    <!-- <input type="file" name="archivo" required> -->
                    <input type="file" class="form-control" name="documentacion_soporte[]" id="documentacion_soporte" accept="application/pdf" multiple="multiple">
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
                    <div class="alert alert-danger">Seleccione el tipo de institucion nacional/internacional solo si se requiere realizar cambios</div>

                    <div class="form-check d-flex flex-wrap justify-content-around mt-4 mb-4 px-auto">
                        <div class="form-check mr-2">
                            <input class="form-check-input" type="radio" name="tipo_institucion" id="tipo_institucion" onclick="mostrarSri()" value="Institución Nacional">
                            <label class="form-check-label mr-2">
                                Institución Nacional
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo_institucion" onclick="mostrarSri()" value="Institución Internacional"/>
                            <label class="form-check-label">
                                Institución Internacional
                            </label>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="ruc_institucion" class="form-label">RUC *:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="ruc_institucion" name="ruc_institucion" value="{{$formulario->ruc_institucion}}">
                            {{-- <input type="text" class="form-control" id="ruc_institucion" name="ruc_institucion" value="{{old('ruc_institucion')}}"> --}}
                            
                            <div class="input-group-append">
                                {{-- <button class="input-group-text" id="boton_buscar_ruc" onclick="buscarPorRUC()" style="cursor: pointer">@@</button> --}}
                                <span class="input-group-text" id="boton_buscar_ruc" onclick="buscarPorRUC()" style="cursor: pointer">@@</span>
                            </div>
                        </div>    
                    </div>
                    <div class="mb-3">
                        <label for="razon_social_institucion" class="form-label">Razón Social *:</label>
                        <input type="text" class="form-control" id="razon_social_institucion" name="razon_social_institucion" value="{{$formulario->razon_social_institucion}}"  readonly="readonly">
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
                        <input type="text" class="form-control" id="ciudad_pais_institucion" name="ciudad_pais_institucion" value="{{$formulario->ciudad_pais_institucion}}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="correo_institucion" class="form-label">Correo *:</label>
                        <input type="text" class="form-control" id="correo_institucion" name="correo_institucion" value="{{$formulario->correo_institucion}}" readonly="readonly">
                    </div>
                    @if(isset($formulario))
                    <div class="mb-3">
                        <label for="tipo_institucion" class="form-label">Tipo de institución:</label>
                        <select class="form-select" aria-label="Default select example" id="tipo_institucion2" name="tipo_institucion2">
                            <option value="">Seleccione</option>
                            <option value="PÚBLICA" {{ ($formulario->tipo_institucion2 == "PÚBLICA") ? 'selected' : "" }}>PÚBLICA</option>
                            <option value="PRIVADA" {{ ($formulario->tipo_institucion2 == "PRIVADA") ? 'selected' : "" }}>PRIVADA</option>
                            <option value="ORGANISMO INTERNACIONAL" {{ ($formulario->tipo_institucion2 == "ORGANISMO INTERNACIONAL") ? 'selected' : "" }}>ORGANISMO INTERNACIONAL</option>
                            <option value="TERCER SECTOR" {{ ($formulario->tipo_institucion2 == "TERCER SECTOR") ? 'selected' : "" }}>TERCER SECTOR</option>
                            <option value="OTRAS" {{ ($formulario->tipo_institucion2 == "OTRAS") ? 'selected' : "" }} >OTRAS</option>
                        </select>
                    </div>
                    @endif
                    @if(!isset($formulario))
                    <div class="mb-3">
                        <label for="tipo_institucion" class="form-label">Tipo de institución:</label>
                        <select class="form-select" aria-label="Default select example" id="tipo_institucion2" name="tipo_institucion2">
                            <option value="">Seleccione</option>
                            <option value="PÚBLICA" {{ (old('tipo_institucion2') == "PÚBLICA") ? 'selected' : "" }}>PÚBLICA</option>
                            <option value="PRIVADA" {{ (old('tipo_institucion2') == "PRIVADA") ? 'selected' : "" }}>PRIVADA</option>
                            <option value="ORGANISMO INTERNACIONAL" {{ (old('tipo_institucion2') == "ORGANISMO INTERNACIONAL") ? 'selected' : "" }}>ORGANISMO INTERNACIONAL</option>
                            <option value="TERCER SECTOR" {{ (old('tipo_institucion2') == "TERCER SECTOR") ? 'selected' : "" }}>TERCER SECTOR</option>
                            <option value="OTRAS" {{ (old('tipo_institucion2') == "OTRAS") ? 'selected' : "" }} >OTRAS</option>
                        </select>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="campo_amplio_institucion" class="form-label">Campo Amplio:</label>
                        <input type="text" class="form-control" id="campo_amplio_institucion" name="campo_amplio_institucion" value="{{ ($carrera == 'Informatica' || $carrera == 'TI' ? 'Tecnologías de la Información y la Comunicación' : 'Ingeniería Industria y Construcción') }}" readonly="readonly"/>
                    </div>
                    <div class="mb-3">
                        <label for="campo_especifico_institucion" class="form-label">Campo Específico:</label>
                        <input type="text" class="form-control" id="campo_especifico_institucion" name="campo_especifico_institucion" value="{{ ($carrera == 'Informatica' || $carrera == 'TI' ? 'Tecnologías de la Información y la Comunicación' : 'Ingeniería y profesiones afines') }}" readonly="readonly"/>
                    </div>
                    <div class="mb-3">
                        <label for="codigo_proyecto_institucion" class="form-label">Código Proyecto/Convenio **:</label>
                        <input type="text" class="form-control" id="codigo_proyecto_institucion" name="codigo_proyecto_institucion" value="{{$formulario->codigo_proyecto_convenio}}" >
                    </div>
                    <div class="mb-3">
                        <label for="nombre_proyecto_institucion" class="form-label">Nombre del Proyecto/Convenio:</label>
                        <input type="text" class="form-control" id="nombre_proyecto_institucion" name="nombre_proyecto_institucion" value="{{$formulario->nombre_proyecto_convenio}}" >
                    </div>
                </div>
                </div>
            </div>


            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                    5- Información de las actividades realizadas
                </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" >
                <div class="accordion-body">
                    <div class="mb-3">
                        <label for="resumen_actividades" class="form-label">Breve resumen de las actividades realizadas:</label>
                        <textarea class="form-control" id="resumen_actividades" name="resumen_actividades" rows="2" >{{$formulario->resumen_actividades}}</textarea>
                    </div>            
                    <div class="mb-3">
                        <label for="actividades_realizadas" class="form-label">¿De qué manera las actividades realizadas contribuyeron al perfil de egreso de su carrera?</label>
                        <textarea class="form-control" id="actividades_realizadas" name="actividades_realizadas" rows="2" >{{$formulario->actividades_realizadas}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="aprendizaje_perfil" class="form-label">¿A qué resultados de aprendizaje del perfil de egreso considera que aportaron las actividades realizadas?</label>
                        <textarea class="form-control" id="aprendizaje_perfil" name="aprendizaje_perfil" rows="2" >{{$formulario->aprendizaje_perfil}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="malla_curricular" class="form-label">¿Cuáles son las asignaturas de la malla curricular y las temáticas de mayor utilidad para el desarrollo de las actividades?</label>
                        <textarea class="form-control" id="malla_curricular" name="malla_curricular" rows="2" >{{$formulario->malla_curricular}}</textarea>                        
                    </div>  
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="true" aria-controls="collapseSeven">
                    6- Información Adicional
                </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingTwo" >
                <div class="accordion-body">
                    <div class="mb-3">
                        <label for="nombres" class="form-label">Información de las fechas en las que realizó las actividades</label>
                    </div>
                    <div class="d-flex gap-2 justify-content-around">
                        <div class="mb-3 flex-fill">
                            <label for="fecha_inicio" class="form-label">Fecha Inicio: </label>
                            <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" name="fecha_inicio" value="{{$formulario->fecha_inicio_actividades}}" >
                            @error('fecha_inicio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 flex-fill">
                            <label for="fecha_fin" class="form-label">Fecha Fin: </label>
                            <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin" name="fecha_fin" value="{{$formulario->fecha_fin_actividades}}" />
                            @error('fecha_fin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>                    
                    <div class="mb-3">
                        <label for="horas_solicitadas" class="form-label">Horas Solicitadas: </label>
                        <input type="number" class="form-control" id="horas_solicitadas" name="horas_solicitadas" value="{{$formulario->horas_solicitadas}}"/>
                    </div>

                    <div class="container border p-4 mt-4">  
                        Documentos subidos anteriormente:
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

                    <div class="container border p-4 mt-4">  
                        Nuevos documentos de soporte:
                    </div>
                    <div class="container border p-4 mt-4">  
                        <div class="alert alert-warning">Aqui puede cargar nuevos documentos adicionales</div>
                    </div>
                    <div class="container border p-4 mt-4"> 
                        <!-- <input type="file" name="archivo" required> -->
                        <input type="file" class="form-control" name="informacion_adicional[]" id="informacion_adicional" accept="application/pdf"  multiple="multiple">
                    </div>

                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="true" aria-controls="collapseEight">
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
   
                                <input type="text" class="form-control" name="formulario_id" id="formulario_id" value="{{ $formulario->id }}" hidden>

                                <div class="card-footer text-muted">
                                    <button type="submit" class="btn btn-primary">Actualizar Formulario</button>
                                </div>
                            </form>
                    
                </div>
                </div>
            </div>
            </div>
   
    
</div>

@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Script para confirmar correcion --}}
    <script>

        $('.formulario-corregir').submit(function(e){
            e.preventDefault();
        Swal.fire({
        title: 'Esta seguro que quiere solicitar correciones?',
        text: "Recuerde que esta acción no se podra modificar",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, solicitar correcion!',
        cancelButtonText: 'Cancelar',
        }).then((result) => {
        if (result.isConfirmed) {
 
            this.submit();
        }
        })
        });
        
    </script>


    {{-- Script para confirmar si se quiere actualizar un formulario --}}
    <script>

        $('.formulario-enviar').submit(function(e){
            e.preventDefault();
        Swal.fire({
        title: 'Esta seguro que quiere actualizar el formulario?',
        text: "Recuerde que esta acción no se podra modificar",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, actualizar formulario!',
        cancelButtonText: 'Cancelar',
        }).then((result) => {
        if (result.isConfirmed) {
 
            this.submit();
        }
        })
        });
        
    </script>
    <script>
        function mostrarSri(){
            var institucion_nacional = document.getElementById('tipo_institucion').checked;
    
            var ruc_institucion = document.getElementById('ruc_institucion');
            var razon_social_institucion = document.getElementById('razon_social_institucion');
            var direccion_institucion = document.getElementById('direccion_institucion');
            var telefono_institucion = document.getElementById('telefono_institucion');
            var celular_institucion = document.getElementById('celular_institucion');
            var ciudad_pais_institucion = document.getElementById('ciudad_pais_institucion');
            var correo_institucion = document.getElementById('correo_institucion');
            

            if(institucion_nacional){
                //  Establecer como readonly
                // ruc_institucion.disabled = false;
                // document.getElementById('boton_buscar_ruc').disabled=false;
                ruc_institucion.disabled = false;
                // establecer valores
                razon_social_institucion.value = "";
                ruc_institucion.value = "";
                direccion_institucion.value = "";
                telefono_institucion.value = "";
                celular_institucion.value = "";
                ciudad_pais_institucion.value = "";
                correo_institucion.value = "";
                
            }
            if(!institucion_nacional){// Este if sirve para saber si esta marcado el check que significa que es un Profesor 
                
                ruc_institucion.disabled = true;
                ruc_institucion.value = "N/A";
                razon_social_institucion.value = "N/A";
                direccion_institucion.value = "N/A";
                telefono_institucion.value = "N/A";
                celular_institucion.value = "N/A";
                ciudad_pais_institucion.value = "N/A";
                correo_institucion.value = "N/A";
                //  Establecer como readonly
                
   
            }
    }  

    </script>
@stop



