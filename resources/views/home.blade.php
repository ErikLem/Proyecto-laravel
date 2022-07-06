@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Comisión de Prácticas Preprofesionales</h1>
@stop

@section('content')

    <div class="card flex-fill w-00">
        <div class="card-header">

            <div class="row">
                <div class="col-12 col-lg-6">
                    <p style="text-align:justify; font-size:14px">
                        <b>¿Qué son las Prácticas Pre-profesionales?</b><br><br>
        
                        Se denomina práctica pre-profesional a las actividades de aprendizaje que están orientadas a la aplicación de sus conocimientos y, al desarrollo de destrezas y habilidades específicas que un estudiante debe adquirir para un adecuado desempeño en su futura profesión. Estas prácticas deberán ser de investigación-acción y se realizarán en el entorno institucional, empresarial, o comunitario, público o privado adecuado para el fortalecimiento del aprendizaje.<br><br>	
        
                        Estas prácticas constituyen un requisito académico para la graduación en las condiciones que estipula el normativo de Prácticas la Facultad de Ingeniería Mecánica, así como también las leyes y reglamentos del país.<br><br>
        
                        <br><br><b>¿Cuál es la importancia de las Prácticas Pre-Profesionales?</b><br><br>
        
                        Las prácticas Pre-Profesionales contribuyen a la formación de los futuros ingenieros mecánicos, ya que constituyen un excelente mecanismo para que los estudiantes desarrollen habilidades y destrezas mediante el ejercicio profesional en las distintas industrias y empresas del país y el mundo.<br><br>
        
                        Las prácticas constituyen un medio importante para vincular a la Universidad con las necesidades de la sociedad, así como para difundir los avances científicos y tecnológicos.<br>
        
                    </p>
                        <a href="{{ route('test') }}" class="btn btn-primary btn-block">Salir</a>
                </div>

                <div class="col-12 col-lg-6">
                    <img src="{{ asset('img/photos/epn_dep.jpg') }}" style="width: 600px; height: 500px ">
                </div>
            </div>

            

            

        </div>

    </div>

    
@stop

@section('css')
    <link rel="stylesheet" href="../css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop