@extends('adminlte::page')

@section('title', 'Estudiantes')

@section('content_header')
    <h1>Registros de Validación y Convalidación</h1>
@stop

@section('content')

<div class="row">
    <div class="col-12 col-lg-3"></div>

    <div class="col-12 col-lg-6">
        <div class="card">

            <table class="table table-bordered">
    
                    <tr>
                        <th style="width:20%">Id:</th>
                        <th style="width:80%">Estudiante:</th>
                    </tr>

                    @foreach($student as $var)
                    <tr>
                        
                        <td style="text-align: center">{{ $var->id }}</td>
                        <td style="text-align: center"><a href="{{ route('registros.estudiantes.show',$var) }}">{{ $var->nombres }} {{ $var->apellidos }}</a></td>
                    </tr>
                    @endforeach 
            </table>
            <ul class="pagination justify-content-center">
                {{ $student->links() }}
            </ul> 
        </div>
    </div>
    <div class="col-12 col-lg-3"></div>

    
</div>

@stop

@section('css')
    <link rel="stylesheet" href="../css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop



