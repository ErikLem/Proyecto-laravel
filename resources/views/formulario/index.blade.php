@extends('adminlte::page')

@section('content')

<div class="container border p-4 mt-4">
    <table class="table">
        {{-- SI ESQUE EXISTE ALGUN FORMULARIO --}}
        @if(isset($formularios[0]))


        {{-- ///////////////////////////////////////////////////////////////// --}}
        {{-- ESTE IF MOSTRARA LOS FORMULARIOS EN EL ROL DEL ESTUDIANTE --}}
        {{-- ///////////////////////////////////////////////////////////////// --}}

            @if(auth()->user()->roles->pluck('name')->first() == 'Estudiante')

                <tr>
                    <th>Nº de Proceso</th>
                    <th>Estado</th>
                    <th>Fecha Creación</th>

                    @if($formularios[0]->estado == 'proceso' || $formularios[0]->estado == 'aceptado' || $formularios[0]->estado == 'corregir' )
                        <th>Revisar Formulario</th>
                    @elseif($formularios[0]->estado == 'rechazado')
                        <th>Rechazado por:</th>
                        <th>Revisar Formulario</th>
                    @endif
                </tr>

                @foreach ($formularios as $formulario)
                <tr>
                    {{-- MUESTRA LOS FORMULARIOS DEL ESTUDIANTE --}}
                    <td style="text-transform: capitalize;">{{$formulario->id}}</td>
                    <td style="text-transform: capitalize;">{{$formulario->estado}}</td>
                    <td>{!! date('d/m/Y', strtotime($formulario->created_at)) !!} </td>

                    @if($formulario->estado == 'rechazado')
                        @if($formulario->profesors_id == NULL)
                            <td style="text-transform: capitalize;">SUBDECANO</td>
                        @elseif($formulario->recomendacion_miembro_cpp == NULL)
                            <td style="text-transform: capitalize;">TUTOR</td>
                        @elseif($formulario->firma_cpp == NULL)
                            <td style="text-transform: capitalize;">MIEMBRO DE LA CPP</td>
                        @elseif($formulario->firma_decano == NULL)
                            <td style="text-transform: capitalize;">COORDINADORA DE LA CPP</td>
                        @endif
                    @endif


                    {{-- BOTONES--}}

                    <td style="display: flex; gap: 5px">

                        {{-- Boton para revisar formulario por parte del ESTUDIANTE dependera del repositorio--}}

                        {{-- Nuevos formularios --}}
                        @if($formulario->estado == 'proceso')

                            @section('title', 'Nuevos Formularios')
                            @section('content_header')
                            <h1>Nuevos Formularios</h1>
                            @stop

                            <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-journal-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                        <path
                                            d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                        <path
                                            d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                    </svg>
                                </button>
                            </form>

                        {{-- Formularios rechazados--}}
                        @elseif($formulario->estado == 'rechazado')

                            @section('title', 'Formularios Rechazados')
                            @section('content_header')
                            <h1>Formularios Rechazados</h1>
                            @stop

                            <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-journal-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                        <path
                                            d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                        <path
                                            d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                    </svg>
                                </button>
                            </form>

                        {{-- Formularios aceptados --}}
                        @elseif($formulario->estado == 'aceptado')

                            @section('title', 'Formularios Aceptados')
                            @section('content_header')
                            <h1>Formularios Aceptados</h1>
                            @stop

                            <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-journal-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                        <path
                                            d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                        <path
                                            d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                    </svg>
                                </button>
                            </form>


                            {{-- Formularios para corregir--}}
                            @elseif($formulario->estado == 'corregir')

                                @section('title', 'Formularios Corregir')
                                @section('content_header')
                                <h1>Formularios para Corregir</h1>
                                @stop

                                <form action="{{route('formulario.aceptarcorreccion', $formulario->id)}}" method="GET">
                                    @csrf
                                    <button class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                            class="bi bi-journal-check" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                            <path
                                                d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                            <path
                                                d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                        </svg>
                                    </button>
                                </form>

                                 {{-- Formularios corregidos --}}
                        @elseif($formulario->estado == 'corregido')

                        @section('title', 'Formularios Corregidos')
                        @section('content_header')
                        <h1>Formularios Corregidos</h1>
                        @stop

                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        @endif
                    </td>
                </tr>
                @endforeach

            {{-- ///////////////////////////////////////////////////////////////// --}}
            {{-- ESTE IF MOSTRARA LOS FORMULARIOS EN EL ROL DEL SUBDECANO --}}
            {{-- ///////////////////////////////////////////////////////////////// --}}

            @elseif(auth()->user()->roles->pluck('name')->first() == 'Subdecano')

                <tr>
                    <th>Nº de Proceso</th>
                    <th>Estudiante</th>
                    <th>Estado</th>
                    <th>Fecha Creación</th>
        
                    @if($formularios[0]->estado == 'proceso' || $formularios[0]->estado == 'corregir')
                        <th>Revisar Formulario</th>
                    @elseif($formularios[0]->estado == 'rechazado')
                        <th>Rechazado por:</th>
                        <th>Revisar Formulario</th>
                    @endif

                </tr>

                @foreach ($formularios as $formulario)
                <tr>
                    
                    <td style="text-transform: capitalize;">{{$formulario->id}}</td>
                    <td style="text-transform: capitalize;">{{$formulario->nombres}} {{$formulario->apellidos}}</td>
                    <td style="text-transform: capitalize;">{{$formulario->estado}}</td>
                    <td>{!! date('d/m/Y', strtotime($formulario->created_at)) !!}</td>

                    @if($formulario->estado == 'rechazado')
                        @if($formulario->profesors_id == NULL)
                        <td style="text-transform: capitalize;">SUBDECANO</td>
                        @elseif($formulario->recomendacion_miembro_cpp == NULl)
                        <td style="text-transform: capitalize;">TUTOR</td>
                        @elseif($formulario->firma_cpp == NULL)
                        <td style="text-transform: capitalize;">MIEMBRO DE LA CPP</td>
                        @elseif($formulario->firma_decano == NULL)
                        <td style="text-transform: capitalize;">COORDINADORA DE LA CPP</td>
                        @endif
                    @endif

                    {{-- ACCIONES EN VER FORMULARIO MUESTRA LAS ACCIONES--}}

                    <td style="display: flex; gap: 5px">

                        {{-- Botones para revisar formulario por parte del SUBDECANO de acuerdo al repositorio --}}

                        {{-- Reviso el estado del formulario, solo los rechazados y con tutor ya asignado --}}
                        {{-- Van a la ruta, formulario.revisar --}}

                        {{-- Nuevos formularios --}}

                        @if($formulario->profesors_id == NULL && $formulario->estado == 'proceso')

                        @section('title', 'Nuevos Formularios')
                        @section('content_header')
                        <h1>Nuevos Formularios</h1>
                        @stop

                        <form action="{{route('formulario.aceptar', $formulario->id)}}" method="GET">
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        {{-- Formularios revisados --}}
                        @elseif($formulario->profesors_id != NULL && $formulario->estado == 'proceso')

                        @section('title', 'Formularios Revisados')
                        @section('content_header')
                        <h1>Formularios Revisados</h1>
                        @stop

                                        {{-- Para revisar --}}
                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>
                        
                        @elseif($formulario->estado == 'rechazado')

                        @section('title', 'Formularios Rechazados')
                        @section('content_header')
                        <h1>Formularios Rechazados</h1>
                        @stop
                                        {{-- Para revisar --}}
                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        @elseif($formulario->estado == 'corregir')

                        @section('title', 'Formularios Corregir')
                        @section('content_header')
                        <h1>Formularios para Corregir</h1>
                        @stop
                                        {{-- Para revisar --}}
                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        {{-- formularios corregidos --}}

                        @elseif($formulario->profesors_id == NULL && $formulario->estado == 'corregido')

                        @section('title', 'Formularios corregidos')
                        @section('content_header')
                        <h1>Formularios corregidos</h1>
                        @stop

                        <form action="{{route('formulario.aceptar', $formulario->id)}}" method="GET">
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        @endif
                    </td>
                </tr>
                @endforeach

            {{-- //////////////////////////////////////////////////// --}}
            {{-- ESTE IF MOSTRARA LOS FORMULARIOS EN EL ROL DEL TUTOR --}}
            {{-- //////////////////////////////////////////////////// --}}

            @elseif(auth()->user()->roles->pluck('name')->first() == 'Tutor')

                <tr>
                    <th>Nº de Proceso</th>
                    <th>Estudiante</th>
                    <th>Estado</th>
                    <th>Fecha Creación</th>

                    @if($formularios[0]->estado == 'proceso')
                        <th>Revisar Formulario</th>
                    @elseif($formularios[0]->estado == 'rechazado')
                        <th>Rechazado por:</th>
                        <th>Revisar Formulario</th>
                    @endif

                </tr>

                @foreach ($formularios as $formulario)
                <tr>

                    <td style="text-transform: capitalize;">{{$formulario->id}}</td>
                    <td style="text-transform: capitalize;">{{$formulario->nombres}} {{$formulario->apellidos}}</td>
                    <td style="text-transform: capitalize;">{{$formulario->estado}}</td>
                    <td>{!! date('d/m/Y', strtotime($formulario->created_at)) !!}</td>

                    @if($formulario->estado == 'rechazado')
                        @if($formulario->profesors_id == NULL)
                        <td style="text-transform: capitalize;">SUBDECANO</td>
                        @elseif($formulario->recomendacion_miembro_cpp == NULl)
                        <td style="text-transform: capitalize;">TUTOR</td>
                        @elseif($formulario->firma_cpp == NULL)
                        <td style="text-transform: capitalize;">MIEMBRO DE LA CPP</td>
                        @elseif($formulario->firma_decano == NULL)
                        <td style="text-transform: capitalize;">COORDINADORA DE LA CPP</td>
                        @endif
                    @endif


                    {{-- ACCIONES EN VER FORMULARIO MUESTRA LAS ACCIONES--}}

                    <td style="display: flex; gap: 5px">

                        {{-- Boton para revisar formulario por parte del TUTOR de acuerdo al repositorio --}}

                        {{-- Nuevos formularios --}}
                        @if($formulario->firma_tutor == NULL && $formulario->estado == 'proceso')

                        @section('title', 'Nuevos Formularios')
                        @section('content_header')
                        <h1>Nuevos Formularios</h1>
                        @stop

                        <form action="{{route('formulario.aceptar.tutor', $formulario->id)}}" method="GET">
                            {{-- @method('PUT') --}}
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        {{-- Formularios revisados --}}
                        @elseif($formulario->firma_tutor != NULL && $formulario->estado == 'proceso')

                        @section('title', 'Formularios Revisados')
                        @section('content_header')
                        <h1>Formularios Revisados</h1>
                        @stop

                        {{-- Boton para visualizar --}}
                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        {{-- Formularios rechazados --}}
                        @elseif($formulario->estado == 'rechazado')

                        @section('title', 'Formularios Rechazados')
                        @section('content_header')
                        <h1>Formularios Rechazados</h1>
                        @stop

                        {{-- Boton para visualizar --}}
                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        {{-- PARA CORREGIR --}}
                        @elseif($formulario->estado == 'corregir')

                        @section('title', 'Formularios Corregir')
                        @section('content_header')
                        <h1>Formularios para Corregir</h1>
                        @stop
                                        {{-- Para revisar --}}
                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        {{-- formularios corregidos --}}

                        @elseif($formulario->profesors_id != NULL && $formulario->estado == 'corregido' && $formulario->recomendacion_miembro_cpp==NULL)

                        @section('title', 'Formularios corregidos')
                        @section('content_header')
                        <h1>Formularios corregidos</h1>
                        @stop

                        <form action="{{route('formulario.aceptar.tutor', $formulario->id)}}" method="GET">
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        @endif
                    
                    </td>

                </tr>
                @endforeach

            {{-- ////////////////////////////////////////////////////////// --}}
            {{-- ESTE IF MOSTRARA LOS FORMULARIOS EN EL ROL DEL MIEMBRO CPP --}}
            {{-- ////////////////////////////////////////////////////////// --}}

            @elseif(auth()->user()->roles->pluck('name')->first() == 'Miembro CPPP')

                <tr>
                    <th>Nº de Proceso</th>
                    <th>Estudiante</th>
                    <th>Estado</th>
                    <th>Fecha Creación</th>

                    @if($formularios[0]->estado == 'proceso')
                        <th>Revisar Formulario</th>
                    @elseif($formularios[0]->estado == 'rechazado')
                        <th>Rechazado por:</th>
                        <th>Revisar Formulario</th>
                    @endif

                </tr>

                @foreach ($formularios as $formulario)
                <tr>

                    <td style="text-transform: capitalize;">{{$formulario->id}}</td>
                    <td style="text-transform: capitalize;">{{$formulario->nombres}} {{$formulario->apellidos}}</td>
                    <td style="text-transform: capitalize;">{{$formulario->estado}}</td>
                    <td>{!! date('d/m/Y', strtotime($formulario->created_at)) !!}</td>

                    @if($formulario->estado == 'rechazado')
                        @if($formulario->profesors_id == NULL)
                        <td style="text-transform: capitalize;">SUBDECANO</td>
                        @elseif($formulario->recomendacion_miembro_cpp == NULl)
                        <td style="text-transform: capitalize;">TUTOR</td>
                        @elseif($formulario->firma_cpp == NULL)
                        <td style="text-transform: capitalize;">MIEMBRO DE LA CPP</td>
                        @elseif($formulario->firma_decano == NULL)
                        <td style="text-transform: capitalize;">COORDINADORA DE LA CPP</td>
                        @endif
                    @endif


                    {{-- ACCIONES EN VER FORMULARIO MUESTRA LAS ACCIONES--}}

                    <td style="display: flex; gap: 5px">

                        {{-- Boton para revisar formulario por parte del TUTOR de acuerdo al repositorio --}}

                        {{-- Nuevos formularios --}}
                        @if($formulario->firma_tutor != NULL && $formulario->estado == 'proceso' && $formulario->firma_cpp==NULL && $formulario->recomendacion_miembro_cpp== NULL)


                        @section('title', 'Nuevos Formularios')
                        @section('content_header')
                        <h1>Nuevos Formularios</h1>
                        @stop

                        <form action="{{route('formulario.aceptar.miembrocpp', $formulario->id)}}" method="GET">
                            {{-- @method('PUT') --}}
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        {{-- Formularios revisados --}}
                        @elseif($formulario->firma_tutor != NULL && $formulario->estado == 'proceso' && $formulario->firma_cpp==NULL && $formulario->recomendacion_miembro_cpp != NULL)


                        @section('title', 'Formularios Revisados')
                        @section('content_header')
                        <h1>Formularios Revisados</h1>
                        @stop

                        {{-- Boton para visualizar --}}
                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        {{-- Formularios rechazados --}}
                        @elseif($formulario->estado == 'rechazado')

                        @section('title', 'Formularios Rechazados')
                        @section('content_header')
                        <h1>Formularios Rechazados</h1>
                        @stop

                        {{-- Boton para visualizar --}}
                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                            {{-- PARA CORREGIR --}}
                            @elseif($formulario->estado == 'corregir')

                            @section('title', 'Formularios Corregir')
                            @section('content_header')
                            <h1>Formularios para Corregir</h1>
                            @stop
                                            {{-- Para revisar --}}
                            <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-journal-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                        <path
                                            d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                        <path
                                            d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                    </svg>
                                </button>
                            </form>
    
                            {{-- formularios corregidos --}}
    
                            @elseif($formulario->profesors_id != NULL && $formulario->estado == 'corregido' && $formulario->recomendacion_miembro_cpp==NULL)
    
                            @section('title', 'Formularios corregidos')
                            @section('content_header')
                            <h1>Formularios corregidos</h1>
                            @stop
    
                            <form action="{{route('formulario.aceptar.miembrocpp', $formulario->id)}}" method="GET">
                                @csrf
                                <button class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                        class="bi bi-journal-check" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd"
                                            d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                        <path
                                            d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                        <path
                                            d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                    </svg>
                                </button>
                            </form>
                        @endif
                    
                    </td>

                </tr>
                @endforeach
                
            {{-- //////////////////////////////////////////////////// --}}
            {{-- ESTE IF MOSTRARA LOS FORMULARIOS EN EL ROL DE LA CPP --}}
            {{-- //////////////////////////////////////////////////// --}}

            @elseif(auth()->user()->roles->pluck('name')->first() == 'Coordinador CPPP')

                <tr>
                    <th>Nº de Proceso</th>
                    <th>Estudiante</th>
                    <th>Estado</th>
                    <th>Fecha Creación</th>

                    @if($formularios[0]->estado == 'proceso')
                        <th>Revisar Formulario</th>
                    @elseif($formularios[0]->estado == 'rechazado')
                        <th>Rechazado por:</th>
                        <th>Revisar Formulario</th>
                    @endif

                </tr>

                @foreach ($formularios as $formulario)
                <tr>

                    <td style="text-transform: capitalize;">{{$formulario->id}}</td>
                    <td style="text-transform: capitalize;">{{$formulario->nombres}} {{$formulario->apellidos}}</td>
                    <td style="text-transform: capitalize;">{{$formulario->estado}}</td>
                    <td>{!! date('d/m/Y', strtotime($formulario->created_at)) !!}</td>

                    @if($formulario->estado == 'rechazado')
                        @if($formulario->profesors_id == NULL)
                        <td style="text-transform: capitalize;">SUBDECANO</td>
                        @elseif($formulario->recomendacion_miembro_cpp == NULl)
                        <td style="text-transform: capitalize;">TUTOR</td>
                        @elseif($formulario->firma_cpp == NULL)
                        <td style="text-transform: capitalize;">MIEMBRO DE LA CPP</td>
                        @elseif($formulario->firma_decano == NULL)
                        <td style="text-transform: capitalize;">COORDINADORA DE LA CPP</td>
                        @endif
                    @endif


                    {{-- ACCIONES EN VER FORMULARIO MUESTRA LAS ACCIONES--}}

                    <td style="display: flex; gap: 5px">

                        {{-- Boton para revisar formulario por parte del TUTOR de acuerdo al repositorio --}}

                        {{-- Nuevos formularios --}}
                        @if($formulario->firma_tutor != NULL && $formulario->estado == 'proceso' && $formulario->firma_cpp==NULL)

                        @section('title', 'Nuevos Formularios')
                        @section('content_header')
                        <h1>Nuevos Formularios</h1>
                        @stop

                        <form action="{{route('formulario.aceptar.comision', $formulario->id)}}" method="GET">
                            {{-- @method('PUT') --}}
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        {{-- Formularios revisados --}}
                        @elseif($formulario->firma_tutor != NULL && $formulario->estado == 'proceso' && $formulario->firma_cpp!=NULL && $formulario->firma_decano==NULL)


                        @section('title', 'Formularios Revisados')
                        @section('content_header')
                        <h1>Formularios Revisados</h1>
                        @stop

                        {{-- Boton para visualizar --}}
                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        {{-- Formularios rechazados --}}
                        @elseif($formulario->estado == 'rechazado')

                        @section('title', 'Formularios Rechazados')
                        @section('content_header')
                        <h1>Formularios Rechazados</h1>
                        @stop

                        {{-- Boton para visualizar --}}
                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        {{-- Formularios aceptados --}}
                        @elseif($formulario->estado == 'aceptado')

                        @section('title', 'Formularios Aceptados')
                        @section('content_header')
                        <h1>Formularios Aceptados</h1>
                        @stop

                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                             {{-- PARA CORREGIR --}}
                             @elseif($formulario->estado == 'corregir')

                             @section('title', 'Formularios Corregir')
                             @section('content_header')
                             <h1>Formularios para Corregir</h1>
                             @stop
                                             {{-- Para revisar --}}
                             <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                                 @method('PUT')
                                 @csrf
                                 <button class="btn btn-primary">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         class="bi bi-journal-check" viewBox="0 0 16 16">
                                         <path fill-rule="evenodd"
                                             d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                         <path
                                             d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                         <path
                                             d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                     </svg>
                                 </button>
                             </form>
     
                             {{-- formularios corregidos --}}
     
                             @elseif($formulario->profesors_id != NULL && $formulario->estado == 'corregido' && $formulario->recomendacion_miembro_cpp!=NULL)
     
                             @section('title', 'Formularios corregidos')
                             @section('content_header')
                             <h1>Formularios corregidos</h1>
                             @stop
     
                             <form action="{{route('formulario.aceptar.comision', $formulario->id)}}" method="GET">
                                 @csrf
                                 <button class="btn btn-primary">
                                     <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                         class="bi bi-journal-check" viewBox="0 0 16 16">
                                         <path fill-rule="evenodd"
                                             d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                         <path
                                             d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                         <path
                                             d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                     </svg>
                                 </button>
                             </form>

                        @endif
                    
                    </td>

                </tr>
                @endforeach
                    

            {{-- ///////////////////////////////////////////////////// --}}
            {{-- ESTE IF MOSTRARA LOS FORMULARIOS EN EL ROL DEL DECANO --}}
            {{-- ///////////////////////////////////////////////////// --}}
        
            @elseif(auth()->user()->roles->pluck('name')->first() == 'Decano')

                <tr>
                    <th>Nº de Proceso</th>
                    <th>Estudiante</th>
                    <th>Estado</th>
                    <th>Fecha Creación</th>

                    @if($formularios[0]->estado == 'proceso')
                        <th>Revisar Formulario</th>
                    @elseif($formularios[0]->estado == 'rechazado')
                        <th>Rechazado por:</th>
                        <th>Revisar Formulario</th>
                    @elseif($formularios[0]->estado == 'aceptado')
                        <th>Revisar Formulario</th>
                        <th>Descargar PDF</th>
                    @endif
                    
                </tr>

                @foreach ($formularios as $formulario)
                <tr>

                    <td style="text-transform: capitalize;">{{$formulario->id}}</td>
                    <td style="text-transform: capitalize;">{{$formulario->nombres}} {{$formulario->apellidos}}</td>
                    <td style="text-transform: capitalize;">{{$formulario->estado}}</td>
                    <td>{!! date('d/m/Y', strtotime($formulario->created_at)) !!}</td>

                    @if($formulario->estado == 'rechazado')
                        @if($formulario->profesors_id == NULL)
                        <td style="text-transform: capitalize;">SUBDECANO</td>
                        @elseif($formulario->recomendacion_miembro_cpp == NULl)
                        <td style="text-transform: capitalize;">TUTOR</td>
                        @elseif($formulario->firma_cpp == NULL)
                        <td style="text-transform: capitalize;">MIEMBRO DE LA CPP</td>
                        @elseif($formulario->firma_decano == NULL)
                        <td style="text-transform: capitalize;">COORDINADORA DE LA CPP</td>
                        @endif
                    @endif

                    {{-- ACCIONES EN VER FORMULARIO MUESTRA LAS ACCIONES--}}

                    <td style="display: flex; gap: 5px">

                        {{-- Boton para revisar formulario por parte del DECANO --}}

                        {{-- Nuevos Formularios --}}
                        @if($formulario->firma_cpp != NULL && $formulario->estado == 'proceso' && $formulario->firma_decano==NULL)

                        @section('title', 'Nuevos Formularios')
                        @section('content_header')
                        <h1>Nuevos Formularios</h1>
                        @stop

                        {{-- Botono para revisar los formularios nuevos --}}
                        <form action="{{route('formulario.aceptar.decano', $formulario->id)}}" method="GET">

                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>

                        @elseif($formulario->firma_cpp != NULL && $formulario->estado == 'aceptado' && $formulario->firma_decano!=NULL)

                        @section('title', 'Formularios Revisados')
                        @section('content_header')
                        <h1>Formularios Revisados</h1>
                        @stop

                        {{-- Boton para visualizar los formularios que ya lleno la comision --}}
                        <form action="{{route('formulario.revisar', $formulario->id)}}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>
                        {{-- Botono para descargar PDF final --}}
                    <td>
                        <form action="{{route('generar.pdf', $formulario->id)}}" method="GET">

                            @csrf
                            <button class="btn btn-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-journal-check" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                                    <path
                                        d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                    <path
                                        d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                </svg>
                            </button>
                        </form>
                    </td>
                    @endif
                </td>
                
                </tr>
                @endforeach
            @endif
        {{-- PARA CUANDO NO HAY FORMULARIOS --}}
        @else

            @section('content_header')
            <h1>No existen formularios</h1>
            @stop

            <th>Nº de Proceso</th>
            <th>Estudiante</th>
            <th>Estado</th>
            <th>Fecha Creación</th>
            <th>Revisar Formulario</th>

        @endif
    </table>
</div>
@stop


{{-- SECCION DE SCRIPTS --}}
@section('css')
<link rel="stylesheet" href="../css/admin_custom.css">
@stop

@section('js')
<script>
    console.log('Hi!'); 
</script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session('enviado') == 'ok')
<script>
    Swal.fire(
            'Enviado',
            'El formulario se ha enviado correctamente',
            'success'
            )
</script>
@endif

@if(session('asignado') == 'ok')
<script>
    Swal.fire(
        'Asignado',
        'El tutor ha sido asignado de forma correcta',
        'success'
        )
</script>
@endif

@if(session('completado') == 'ok')
<script>
    Swal.fire(
        'Proceso terminado',
        'Se ha terminado con exito este formulario, puede descargar el PDF en la sección de formularios revisados',
        'success'
        )
</script>
@endif

@if(session('rechazado') == 'ok')
<script>
    Swal.fire(
        'Formulario rechazado',
        '',
        'success'
        )
</script>
@endif

@stop