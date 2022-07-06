@extends('adminlte::page')

@section('title', 'Nuevo Estudiante')

@section('content_header')
    <h1>Datos del Nuevo estudiante</h1>
@stop

@section('content')
    <div class="container w-50 border p-4 mt-4">
        <form action="{{ route('estudiantes.insert') }}" method="POST">
            @csrf        
            <div class="mb-3">
                <label for="carrera" class="form-label">Carrera</label>
                <input type="text" class="form-control" id="carrera" name="carrera" value="{{ $estudiantes->carrera }}" readonly="readonly">
            </div>
            <div class="mb-3">
                <label for="nombres" class="form-label">Nombres</label>
                <input type="text" class="form-control" id="nombres" name="nombres" value="{{ $estudiantes->nombres }}" readonly="readonly">
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="{{ $estudiantes->apellidos }}" readonly="readonly">
            </div>
            <div class="mb-3">
                <label for="cedula" class="form-label">C&eacute;dula</label>
                <input type="text" class="form-control" id="cedula" name="cedula" value="{{ $estudiantes->cedula }}" readonly="readonly">
            </div>
            
            <div class="mb-3">
                <label for="correo" class="form-label">Correo</label>
                <input type="email" class="form-control" id="correo" name="correo" aria-describedby="emailHelp" value="{{ $estudiantes->correo }}" readonly="readonly">
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Tel&eacute;fono</label>
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $estudiantes->telefono }}" readonly="readonly">
            </div>
            <div class="mb-3">
                <label for="celular" class="form-label">Celular</label>
                <input type="text" class="form-control" id="celular" name="celular" value="{{ $estudiantes->celular }}" readonly="readonly">
            </div>        
            <div class="mb-3">
                <label for="epn" class="form-label">EPN</label>
                <input type="text" class="form-control @error('epn') is-invalid @enderror" id="epn" name="epn" value="{{ $estudiantes->epn }}" readonly="readonly">
            </div>
            <button type="submit" class="btn btn-primary">Crear Estudiante</button>
        </form>
    </div>
@endsection