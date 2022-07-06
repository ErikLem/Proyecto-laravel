@extends('adminlte::page')

@section('title', 'Editar')

@section('content_header')
    <h1>Asignación de Roles</h1>
@stop

@section('content')

@if(session('Info'))
    <div class="alert alert-success">
        <strong>{{ session('Info') }}</strong>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <p class="h5"> Nombre: </p>    
        <p class="form-control"> {{ $usuario->name }} </p>  
            <h2 class="h5">Roles :</h2>
            <b>{{ $usuario->roles->pluck('name')->implode(', ') }}</b><br><br>
            <h2 class="h5">Listado de roles: </h2>
            <form action="{{ route('usuarios.update', $usuario) }}" method="post">
                
                @csrf
				@method('put')		
                <div class="form-group">
                @foreach($roles as $role)
                            {!! Form::checkbox('roles[]', $role->id, null, ['class'=> 'mr-2 mt-2']) !!}
                            {{$role->name}}<br>                  
                @endforeach 
                </div><br>
                <div class="row">
                    <div class="col-12 col-lg-3">
                            <div class="card">	
                                {!! Form::submit('Asignar rol', ['class'=>'btn btn-primary btn-block'])!!}	
                            </div>
                                
                    </div>
                    <div class="col-12 col-lg-3">
                            <div class="card">	
                                    
                            </div>
                                
                    </div>
                    <div class="col-12 col-lg-3">
                            <div class="card">	
                                    
                            </div>
                                
                    </div>

                    <div class="col-12 col-lg-3">
                            <div class="card">	
                                <a href="{{ route('usuarios.index') }}" class="btn btn-primary btn-block">Salir</a>
                            </div>
                                
                    </div>
                </div>
                
                
            </form>
    </div>
</div>
        
    
@stop

@section('css')
    <link rel="stylesheet" href="../css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
