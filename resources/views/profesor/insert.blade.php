@extends('adminlte::page')

@section('title', 'Nuevo Profesor')

@section('content_header')
    <h1>Datos del Nuevo Profesor</h1>
@stop

@section('content')
    <div class="container w-50 border p-4 mt-4">
        @if(session()->has('nombres'))
            <h3>{{session('nombres')}}</h3>
        @endif
    <form action="{{route('profesores.insert')}}" method="POST">
        @csrf

        @if (session('success'))
            <h6 class="alert alert-success">{{session('success')}}</h6>
        @endif

        
        <div class="mb-3">
            <label for="departamento" class="form-label">Departamento</label>
            <input type="text" class="form-control" id="departamento" name="departamento" value="{{ $profesor->departamento }}" readonly="readonly">
        </div>
        <div class="mb-3">
            <label for="nombres" class="form-label">Nombres</label>
            <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $profesor->nombres }}" readonly="readonly">
        </div>
        <div class="mb-3">
            <label for="apellidos" class="form-label">Apellidos</label>
            <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $profesor->apellidos }}" readonly="readonly">
        </div>
        <div class="mb-3">
            <label for="cedula" class="form-label">C&eacute;dula</label>
            <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $profesor->cedula }}" readonly="readonly">
        </div>
        
        <div class="mb-3">
            <label for="correo" class="form-label">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" aria-describedby="emailHelp" value="{{ $profesor->correo }}" readonly="readonly">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Tel&eacute;fono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $profesor->telefono }}" readonly="readonly">
        </div>
        <div class="mb-3">
            <label for="celular" class="form-label">Celular</label>
            <input type="text" class="form-control" id="celular" name="celular" value="{{ $profesor->celular }}" readonly="readonly">
        </div>        
        <div class="mb-3">
            <label for="epn" class="form-label">EPN</label>
            <input type="text" class="form-control" id="epn" name="epn" value="{{ $profesor->epn }}" readonly="readonly">
        </div>
        <button type="submit" class="btn btn-primary">Crear Profesor</button>
    </form>

    </div>
@endsection

