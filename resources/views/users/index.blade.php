@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')


    <div class="card">
        <div class="card-header">
            <table class="table">             
                    <tr>
                        <td><b>Id</b></td>
                        <td><b>Nombre</b></td>
                        <td><b>Roles</b></td>
                        <td><b>E-mail</b></td>
                        <td></td>   
                        <td></td>                      
                    </tr>
                    @foreach($user as $usuario)	
                    <tr>
                        	
                            <td>{{ $usuario->id }}</td>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->roles->pluck('name')->implode(', ') }}
                            <td>{{ $usuario->email }}</td>
                            <td align="right"><a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-info btn-block">Editar</a></td>
                            <td><form action="{{ route('usuarios.destroy', $usuario) }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger btn-block" value="Eliminar">
                            </form></td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="../css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
