<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

@extends('adminlte::page')

@section('title', 'Nuevo Formulario')

@section('content_header')
    <h1>Crear nuevo formulario</h1>
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

    <form action="{{ route('formulario.insert') }}" method="POST" enctype="multipart/form-data" class="formulario-enviar">
    @csrf 

    {{-- PLANTILLA PARA LLENAR EL NUEVO FORMULARIO --}}
            <div class="card-header">
                <br>
            </div>
            <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" >
                    Carrera
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                <div class="accordion-body">
                    <input type="text" class="form-control" id="carrera" name="carrera" value="{{ $carrera }}" readonly="readonly"/>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    1- Actividades para las que solicita la convalidaci??n
                </button>
                </h2>
                @if(isset($formulario))
                    <input class="form-control" type="text" name="actividad" value="{{$formulario->actividades}}">
                @endif
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" >
                <div class="accordion-body">
          
                    <div class="form-check">
                        <!-- <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="Cursos y Seminarios Profesionales"> -->
                        <input class="form-check-input" type="radio" name="actividad" value="Cursos y Seminarios Profesionales" {{ (old('actividad') == "Cursos y Seminarios Profesionales") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Cursos y Seminarios Profesionales
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Participaci??n Estudiantil en Actividades Acad??micas, de Gesti??n, de Investigaci??n y de Colaboraci??n en Eventos Acad??micos **" {{ (old('actividad') == "Participaci??n Estudiantil en Actividades Acad??micas, de Gesti??n, de Investigaci??n y de Colaboraci??n en Eventos Acad??micos **") ? "checked" : ""}}>
                        <label class="form-check-label">
                            Participaci??n Estudiantil en Actividades Acad??micas, de Gesti??n, de Investigaci??n y de Colaboraci??n en Eventos Acad??micos **
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Represantaci??n Estudiantil" {{ (old('actividad') == "Represantaci??n Estudiantil") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Represantaci??n Estudiantil
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Estudiantes Mentores" {{ (old('actividad') == "Estudiantes Mentores") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Estudiantes Mentores
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Actividades solidarias y de cooperaci??n" {{ (old('actividad') == "Actividades solidarias y de cooperaci??n") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Actividades solidarias y de cooperaci??n
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Actividades solidarias y de cooperaci??n" {{ (old('actividad') == "Actividades solidarias y de cooperaci??n") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Actividades solidarias y de cooperaci??n
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Experiencia Laboral" {{ (old('actividad') == "Experiencia Laboral") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Experiencia Laboral
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Idiomas diferenctes al Ingl??s y Lengua Materna" {{ (old('actividad') == "Idiomas diferenctes al Ingl??s y Lengua Materna") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Idiomas diferenctes al Ingl??s y Lengua Materna
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Direcci??n de ramas de organizaciones estudiantiles acad??micas" {{ (old('actividad') == "Direcci??n de ramas de organizaciones estudiantiles acad??micas") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Direcci??n de ramas de organizaciones estudiantiles acad??micas
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Representaci??n de la Instituci??n en competencias acad??micas" {{ (old('actividad') == "Representaci??n de la Instituci??n en competencias acad??micas") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Representaci??n de la Instituci??n en competencias acad??micas
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Coro y Grupo de C??mara" {{ (old('actividad') == "Coro y Grupo de C??mara") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Coro y Grupo de C??mara
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Participaci??n en la direcci??n de asociaciones de estudiantes" {{ (old('actividad') == "Participaci??n en la direcci??n de asociaciones de estudiantes") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Participaci??n en la direcci??n de asociaciones de estudiantes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actividad" value="Participaci??n en juntas receptoras del voto" {{ (old('actividad') == "Participaci??n en juntas receptoras del voto") ? "checked" : "" }}>
                        <label class="form-check-label">
                            Participaci??n en juntas receptoras del voto
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
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    2- Datos del estudiante
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" >
                <div class="accordion-body">
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" id="id" name="id" value="{{ $id }}" readonly="readonly">
                    </div>
                    <div class="mb-3" hidden>
                        <input type="text" class="form-control" id="epn" name="epn" value="{{ $epn }}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="nombres" class="form-label">Nombres y Apellidos</label>
                        <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $name }}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="cedula" class="form-label">C&eacute;dula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $cedula }}" readonly="readonly">
                    </div>            
                    <div class="mb-3">
                        <label for="correo" class="form-label">Correo</label>
                        <input type="email" class="form-control @error('correo') is-invalid @enderror" id="correo" name="correo" aria-describedby="emailHelp" value="{{ $correo }}">
                        @error('correo')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Tel&eacute;fono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" name="telefono" value="{{ $telefono }}">
                        @error('telefono')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="celular" class="form-label">Celular</label>
                        <input type="text" class="form-control @error('celular') is-invalid @enderror" id="celular" name="celular" value="{{ $celular }}">
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
                    3- Documentaci??n de soporte adjunta
                </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" >
                <div class="accordion-body">
                    <!-- <input type="file" name="archivo" required> -->
                    <input type="file" class="form-control" name="documentacion_soporte[]" id="documentacion_soporte" accept="application/pdf" multiple="multiple">
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    4- Informaci??n de la instituci??n en la que realiz?? las actividades
                </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" >
                <div class="accordion-body">
                    

                    <div class="form-check d-flex flex-wrap justify-content-around mt-4 mb-4 px-auto">
                        <div class="form-check mr-2">
                            <input class="form-check-input" type="radio" name="tipo_institucion" id="tipo_institucion" onclick="mostrarSri()" value="Instituci??n Nacional" checked>
                            <label class="form-check-label mr-2">
                                Instituci??n Nacional
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo_institucion" onclick="mostrarSri()" value="Instituci??n Internacional"/>
                            <label class="form-check-label">
                                Instituci??n Internacional
                            </label>
                        </div>
                    </div>


                    <div class="mb-3">
                        <label for="ruc_institucion" class="form-label">RUC *:</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="ruc_institucion" name="ruc_institucion" value="{{old('ruc_institucion')}}">
                            {{-- <input type="text" class="form-control" id="ruc_institucion" name="ruc_institucion" value="{{old('ruc_institucion')}}"> --}}
                            
                            <div class="input-group-append">
                                {{-- <button class="input-group-text" id="boton_buscar_ruc" onclick="buscarPorRUC()" style="cursor: pointer">@@</button> --}}
                                <span class="input-group-text" id="boton_buscar_ruc" onclick="buscarPorRUC()" style="cursor: pointer">@@</span>
                            </div>
                        </div>    
                    </div>
                    <div class="mb-3">
                        <label for="razon_social_institucion" class="form-label">Raz??n Social *:</label>
                        <input type="text" class="form-control" id="razon_social_institucion" name="razon_social_institucion" value="{{old('razon_social_institucion')}}"  readonly="readonly">
                    </div>                   
                    <div class="mb-3">
                        <label for="direccion_institucion" class="form-label">Direcci??n *:</label>
                        <input type="text" class="form-control" id="direccion_institucion" name="direccion_institucion" value="{{old('direccion_institucion')}}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="telefono_institucion" class="form-label">Tel??fono *:</label>
                        <input type="text" class="form-control" id="telefono_institucion" name="telefono_institucion" value="{{old('telefono_institucion')}}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="celular_institucion" class="form-label">Celular *:</label>
                        <input type="text" class="form-control" id="celular_institucion" name="celular_institucion" value="{{old('celular_institucion')}}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="ciudad_pais_institucion" class="form-label">Ciudad/Pais *:</label>
                        <input type="text" class="form-control" id="ciudad_pais_institucion" name="ciudad_pais_institucion" value="{{old('ciudad_pais_institucion')}}" readonly="readonly">
                    </div>
                    <div class="mb-3">
                        <label for="correo_institucion" class="form-label">Correo *:</label>
                        <input type="text" class="form-control" id="correo_institucion" name="correo_institucion" value="{{old('correo_institucion')}}" readonly="readonly">
                    </div>
                    @if(isset($formulario))
                    <div class="mb-3">
                        <label for="" class="form-label">Tipo_Institucion 2 *:</label>
                        <input type="text" class="form-control" id="tipo_institucion2" name="tipo_institucion2" value="{{$formulario->tipo_institucion2}}" >
                    </div>
                    @endif
                    @if(!isset($formulario))
                    <div class="mb-3">
                        <label for="tipo_institucion" class="form-label">Tipo de instituci??n:</label>
                        <select class="form-select" aria-label="Default select example" id="tipo_institucion2" name="tipo_institucion2">
                            <option value="">Seleccione</option>
                            <option value="P??BLICA" {{ (old('tipo_institucion2') == "P??BLICA") ? 'selected' : "" }}>P??BLICA</option>
                            <option value="PRIVADA" {{ (old('tipo_institucion2') == "PRIVADA") ? 'selected' : "" }}>PRIVADA</option>
                            <option value="ORGANISMO INTERNACIONAL" {{ (old('tipo_institucion2') == "ORGANISMO INTERNACIONAL") ? 'selected' : "" }}>ORGANISMO INTERNACIONAL</option>
                            <option value="TERCER SECTOR" {{ (old('tipo_institucion2') == "TERCER SECTOR") ? 'selected' : "" }}>TERCER SECTOR</option>
                            <option value="OTRAS" {{ (old('tipo_institucion2') == "OTRAS") ? 'selected' : "" }} >OTRAS</option>
                        </select>
                    </div>
                    @endif
                    <div class="mb-3">
                        <label for="campo_amplio_institucion" class="form-label">Campo Amplio:</label>
                        <input type="text" class="form-control" id="campo_amplio_institucion" name="campo_amplio_institucion" value="{{ ($carrera == 'Informatica' || $carrera == 'TI' ? 'Tecnolog??as de la Informaci??n y la Comunicaci??n' : 'Ingenier??a Industria y Construcci??n') }}" readonly="readonly"/>
                    </div>
                    <div class="mb-3">
                        <label for="campo_especifico_institucion" class="form-label">Campo Espec??fico:</label>
                        <input type="text" class="form-control" id="campo_especifico_institucion" name="campo_especifico_institucion" value="{{ ($carrera == 'Informatica' || $carrera == 'TI' ? 'Tecnolog??as de la Informaci??n y la Comunicaci??n' : 'Ingenier??a y profesiones afines') }}" readonly="readonly"/>
                    </div>
                    <div class="mb-3">
                        <label for="codigo_proyecto_institucion" class="form-label">C??digo Proyecto/Convenio **:</label>
                        <input type="text" class="form-control" id="codigo_proyecto_institucion" name="codigo_proyecto_institucion" value="" >
                    </div>
                    <div class="mb-3">
                        <label for="nombre_proyecto_institucion" class="form-label">Nombre del Proyecto/Convenio:</label>
                        <input type="text" class="form-control" id="nombre_proyecto_institucion" name="nombre_proyecto_institucion" value="" >
                    </div>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    5- Informaci??n de las actividades realizadas
                </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" >
                <div class="accordion-body">
                    <div class="mb-3">
                        <label for="resumen_actividades" class="form-label">Breve resumen de las actividades realizadas:</label>
                        <textarea class="form-control" id="resumen_actividades" name="resumen_actividades" rows="2">{{old('resumen_actividades')}}</textarea>
                    </div>            
                    <div class="mb-3">
                        <label for="actividades_realizadas" class="form-label">??De qu?? manera las actividades realizadas contribuyeron al perfil de egreso de su carrera?</label>
                        <textarea class="form-control" id="actividades_realizadas" name="actividades_realizadas" rows="2">{{old('actividades_realizadas')}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="aprendizaje_perfil" class="form-label">??A qu?? resultados de aprendizaje del perfil de egreso considera que aportaron las actividades realizadas?</label>
                        <textarea class="form-control" id="aprendizaje_perfil" name="aprendizaje_perfil" rows="2" >{{old('aprendizaje_perfil')}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="malla_curricular" class="form-label">??Cu??les son las asignaturas de la malla curricular y las tem??ticas de mayor utilidad para el desarrollo de las actividades?</label>
                        <textarea class="form-control" id="malla_curricular" name="malla_curricular" rows="2" >{{old('malla_curricular')}}</textarea>                        
                    </div>  
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                    6- Informaci??n Adicional
                </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingTwo" >
                <div class="accordion-body">
                    <div class="mb-3">
                        <label for="nombres" class="form-label">Informaci??n de las fechas en las que realiz?? las actividades</label>
                    </div>
                    <div class="d-flex gap-2 justify-content-around">
                        <div class="mb-3 flex-fill">
                            <label for="fecha_inicio" class="form-label">Fecha Inicio: </label>
                            <input type="date" class="form-control @error('fecha_inicio') is-invalid @enderror" id="fecha_inicio" name="fecha_inicio" value="{{old('fecha_inicio')}}">
                            @error('fecha_inicio')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 flex-fill">
                            <label for="fecha_fin" class="form-label">Fecha Fin: </label>
                            <input type="date" class="form-control @error('fecha_fin') is-invalid @enderror" id="fecha_fin" name="fecha_fin" value="{{old('fecha_fin')}}">
                            @error('fecha_fin')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>                    
                    <div class="mb-3">
                        <label for="horas_solicitadas" class="form-label">Horas Solicitadas: </label>
                        <input type="number" class="form-control" id="horas_solicitadas" name="horas_solicitadas" value="{{old('horas_solicitadas')}}">
                    </div>
                    <input type="file" class="form-control" name="informacion_adicional[]" id="informacion_adicional" accept="application/pdf"  multiple="multiple">
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                    7- Declaraci??n
                </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" >
                <div class="accordion-body">
                    <div class="mb-3">
                        <p class="form-label">Yo, {{$name}}, declaro que la informaci??n presentada para la convalidaci??n de pr??cticas preprofesionales es ver??dica</p>
                        <label for="fecha_declaracion" class="form-label">Fecha: </label>
                        <input type="date" class="form-control" name="fecha_declaracion" id="fecha_declaracion" value="<?php echo date("Y-m-d");?>" readonly="readonly"/>
                    </div>
                    <div class="mb-3">
                        <label for="firma_declaracion" class="form-label">Firma: </label>
                        <input type="file" class="form-control" name="firma_declaracion" id="firma_declaracion" accept="image/*">
                    </div>
                </div>
                </div>
            </div>
            </div>
            </div>
            <div class="card-footer text-muted">
                <button type="submit" class="btn btn-primary">Crear Formulario</button>
            </div>
</div>
</form>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="../css/admin_custom.css">
@stop

@section('js')

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <script>
         $( function() {
        const profesores = {json_encode($profesores)};
        const listaProfesores = profesores.map(profesor => profesor.nombres);
        var delay = $( "#ruc_institucion" ).autocomplete({
        source: listaProfesores
        });
        // $( "#tags" ).autocomplete({
        //   source: profesores.nombres
        // });
        // $(document).ready(function () {
        // $('#nombre_tutor').on('autocompletechange change', function () {        
        //     if(this.value){
        //         const departamento = profesores.filter(profesor => profesor.nombres === this.value );
        //         $('#departamento_tutor').val(departamento[0].departamento);
        //         $('#nombre_tutor_id').val(departamento[0].user_id);
        //     }
            
        // }).change();
        // });
     } );
 
    </script>

    <script> console.log('Hi!'); </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- PREGUNTA DE SI ESTA SEGURO DE QUE QUIERE ENVIAR EL FORMULARIO --}}
    <script>

        $('.formulario-enviar').submit(function(e){
            e.preventDefault();
        Swal.fire({
        title: 'Esta seguro que quiere enviar el formulario?',
        text: "Asegurese que la informaci??n ingresada es correcta",
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

    {{-- FUNCION PARA SABER SI VA A INGRESAR UNA INSTITUCION NACIONAL O INTERNACIONAL --}}
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

    //FUncion para buscar y establecer los valores encontrador por SRI
    // function buscarPorRUC(){

    //     var institucion_nacional = document.getElementById('tipo_institucion').checked;
    
    //         var ruc_institucion = document.getElementById('ruc_institucion');
    //         var razon_social_institucion = document.getElementById('razon_social_institucion');
    //         var direccion_institucion = document.getElementById('direccion_institucion');
    //         var telefono_institucion = document.getElementById('telefono_institucion');
    //         var celular_institucion = document.getElementById('celular_institucion');
    //         var ciudad_pais_institucion = document.getElementById('ciudad_pais_institucion');
    //         var correo_institucion = document.getElementById('correo_institucion');

    //         if(institucion_nacional){
    //             //  Establecer como readonly
    //             // ruc_institucion.disabled = false;
    //             // document.getElementById('boton_buscar_ruc').disabled=false;

    //             // establecer valores
    //             razon_social_institucion.value = "";
    //             ruc_institucion.value = "";
    //             direccion_institucion.value = "";
    //             telefono_institucion.value = "";
    //             celular_institucion.value = "";
    //             ciudad_pais_institucion.value = "";
    //             correo_institucion.value = "";
    //         }
    //         if(!institucion_nacional){// Este if sirve para saber si esta marcado el check que significa que es un Profesor 
                
    //             razon_social_institucion.value = "N/A";
    //             ruc_institucion.value = "N/A";
    //             direccion_institucion.value = "N/A";
    //             telefono_institucion.value = "N/A";
    //             celular_institucion.value = "N/A";
    //             ciudad_pais_institucion.value = "N/A";
    //             correo_institucion.value = "N/A";
    //             //  Establecer como readonly
    //             // ruc_institucion.disabled = true;
   
    //         }

    // }
    </script>  
  
@stop
