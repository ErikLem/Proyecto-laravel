@extends('adminlte::page')

@section('title', 'Nuevo Usuario')

@section('content_header')
    <h1>Nuevo usuario</h1>
@stop

@section('content')
<body>
        {{-- INGRESO DE ESTUDIANTE POR API --}}

        <div class="container">     
            <div class="row" >
                <div class="col-xl-6 m-auto">
                    <div class="card shadow">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{Session::get('success')}}
                            </div>
                        @elseif(Session::has('failed'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{Session::get('failed')}}
                            </div>
                        @endif

                        <div class="card-body">

                            <div> <center><b>Registrar nuevo Estudiante</b></center></div>
                            <br>

                            <form class="d-flex" action="{{ route('estudiantesEPN') }}" method="POST">
                                @csrf                    
                                @auth
                                <input class="form-control me-2" type="search" placeholder="Ingresa la cedula del Estudiante que desea resgistrar" aria-label="Search" name="busqueda" id="busquedaEstudiante">
                                <br>
                                <button class="btn btn-outline-primary" type="submit" id="btnBusquedaEstudiante">Buscar</button>
                                @endauth        
                            </form>

                    </div>
                </div>
            </div>
       
    </div>

    {{-- INGRESAR TUTOR POR MEDIO DE LA API REST --}}


    <div class="container">
            <div class="row" >
                <div class="col-xl-6 m-auto">
                    <div class="card shadow">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{Session::get('success')}}
                            </div>
                        @elseif(Session::has('failed'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{Session::get('failed')}}
                            </div>
                        @endif

                        <div class="card-body">

                            <div> <center><b>Registrar nuevo Tutor</b></center></div>
                            <br>
                            <form class="d-flex" id="form-profesor" action="{{ route('profesoresEPN') }}" method="POST" hidden>
                                @csrf
                                @auth
                                <input class="form-control me-2" type="search" placeholder="Ingresa la cedula del Profesor que desea resgistrar" aria-label="Search" name="busqueda" id="busquedaProfesor">
                                <br>
                                <button class="btn btn-outline-primary" type="submit" id="btnBusquedaProfesor">Buscar</button>
                                @endauth        
                            </form> 

                    </div>
                </div>
            </div>
    </div>
    {{-- INGRESO MANUAL DE USUARIOS --}}
    <div class="container">
        <form action="{{route('usuarios.store')}}" method="POST">
            @csrf
            
            <div class="row">
                <div class="col-xl-6 m-auto">
                    <div class="card shadow">
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{Session::get('success')}}
                            </div>
                        @elseif(Session::has('failed'))
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                {{Session::get('failed')}}
                            </div>
                        @endif

                        <div class="card-body">
                            <div> <center><b>Resgistros manuales</b></center></div>
                            <br>
                            <div class="form-group">
                                <label for="name"> Nombre <span class="text-primary"> * </span> </label>
                                    <input type="text" name="name" class="form-control" value="{{old('name')}}" />
                                    {!!$errors->first("name", "<span class='text-primary'>:message</span>")!!}
                            </div>

                            <div class="form-group">
                                <label for="email"> Email <span class="text-primary"> * </span> </label>
                                    <input type="text" name="email" class="form-control" value="{{old('email')}}" />
                                    {!!$errors->first("email", "<span class='text-primary'>:message</span>")!!}
                            </div>

                            <div class="form-group">
                                <label for="password"> Contraseña <span class="text-primary"> * </span></label>
                                    <input type="password" name="password" class="form-control" value="{{old('password')}}" />
                                    {!!$errors->first("password", "<span class='text-primary'>:message</span>")!!}
                            </div>

                            <div class="form-group">
                                <label for="confirm_password"> Confirmar Contraseña <span class="text-primary"> * </span></label>
                                    <input type="password" name="confirm_password" class="form-control" value="{{old('confirm_password')}}" />
                                    {!!$errors->first("confirm_password", "<span class='text-primary'>:message</span>")!!}
                            </div>

                            <div class="form-group">
                                <label for="confirm_password"> Seleccione roles <span class="text-primary"> * </span></label><br>
                                    @foreach($role as $role)
                                        {!! Form::checkbox('role[]', $role->id, null, ['class'=> 'mr-2 mt-2']) !!}
                                        {{$role->name}}<br>
                                    @endforeach 
                            </div>

                        <div class="card-footer" align="center">
                            <button type="submit" class="btn btn-primary btn-block"> Registrar </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



  </body>
@stop

@section('css')
    <link rel="stylesheet" href="../css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
{{-- mensaje de error de busqueda de estudiante --}}
    @if(session('creado_estudiante') == 'down')
        <script>
            Swal.fire({
            icon: 'error',
            title: 'El número de cédula ingresado no corresponde a ningun estudiante',
           
            })
        </script>
    @endif
{{-- mensaje de error de busqueda de profesor --}}
    @if(session('creado_profesor') == 'down')
    <script>
        Swal.fire({
        icon: 'error',
        title: 'El número de cédula ingresado no corresponde a ningun profesor',
       
        })
    </script>
    @endif

@stop
