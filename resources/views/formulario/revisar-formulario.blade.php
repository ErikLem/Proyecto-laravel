@extends('adminlte::page')

@section('title', 'Formularios Revisar')

@section('content_header')
    <h1>Resumen de formulario</h1>
@stop

<style>
body {
    margin-right: 20px;
    margin-top: 30px;
    margin-bottom: 40px; 
    font: 'sans-serif';
}

.div1 {        
    width: 25%;
    margin-top: 10px;
}

.div2 {        
    width: 45%;
    text-align: center;
    margin-top: 10px;
}

.div3 {        
    width: 25%;
    margin-left: 30px;
}

.text-center{
    text-align: center;
}

.text-left{
    text-align: left;
}

.text-right{
    text-align: right;
}

.uppercase{
    text-transform: uppercase;
}

.cursiva{
    font-style: italic;
}

.mt-50{
    margin-top: 50px;
}

.mt-40{
    margin-top: 40px;
}

.mt-30{
    margin-top: 30px;
}

.mt-10{
    margin-top: 10px;
}

.ml-20{
    margin-left: 20px;
}

.pl-10{
    padding-left: 10px;
}

.text-red{
    color: red;
}

.font-14{
    font-size: 14px;
}

.font-12{
    font-size: 12px;
}

.font-10{
    font-size: 10px;
}

.font-bold{
    font-weight: bold;
}

.bg-info2{
    background-color: rgb(221, 235, 247);
}

.bg-success2{
    background-color: rgb(198, 224, 180);
}

.bg-warning2{
    background-color: rgb(255, 230, 153);
}

.bg-danger2{
    background-color: rgb(248, 203, 173);
}

.w-full{
    width: 100%;
}

.w-80porc{
    width: 80%;
}

.w-20porc{
    width: 20%;
}

.w-1d3{
    width: 33%;
}

table, th, td {
  border: 2px solid black;
  border-collapse: collapse;
}

.line-height-none{
    line-height: 0;
}

</style>

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
{{-- FORMULARIO EN EL FORMATO ORIGINAL --}}
    <div class="m-5">

        <div>    
            <div class="div1 f-left"><img style="max-width:20%;width:auto;height:auto;" src="{{ asset('storage/Sello_epn.png') }}" alt=""></div>
            <!-- <div class="div1 f-left"><img src="C:\xampp\htdocs\university\university\storage\app\logo.jpeg" width="40px" alt="Logo Universidad"/></div> -->
            <div class="text-center ">
                <p class="line-height-none font-bold font-6 text-center">ESCUELA POLIT??CNICA NACIONAL</p>
                <p class="line-height-none font-bold font-8 text-center">FACULTAD DE CIENCIAS</p>
            </div>
        </div> 
        <br>
        <br>
        <div class="d-flex">
            <div class="font-bold mr-5">
                CARRERA:
            </div>
            <div class="bg-info2 font-bold w-full">
                {{$estudiante->carrera}}
            </div>
        </div>
        <!-- ACTIVIDADES PARA LAS QUE SOLICITA LA CONVALIDACI??N -->
        <div class="mt-10 font-bold bg-success2">
            1. ACTIVIDADES PARA LAS QUE SOLICITA LA CONVALIDACI??N
        </div>
        <table style="width:100%" class="table table-bordered">
            <tr>
                <td style="width: 10%" class="text-center">{{$formulario->actividades == 'Cursos y Seminarios Profesionales' ? 'X' : ''}}</td>
                <td style="width: 35%">Cursos y Seminarios Profesionales
                </td>
                <td style="width: 10%" class="text-center">{{$formulario->actividades == 'Idiomas diferenctes al Ingl??s y Lengua Materna' ? 'X' : ''}}</td>
                <td style="width: 45%">Idiomas diferentes al Ingl??s y Lengua Materna</td>
            </tr>
            <tr>
                <td class="text-center">{{$formulario->actividades == 'Participaci??n Estudiantil en Actividades Acad??micas, de Gesti??n, de Investigaci??n y de Colaboraci??n en Eventos Acad??micos **' ? 'X' : ''}}</td>
                <td>
                    Participaci??n Estudiantil en Actividades Acad??micas, de 
                    Gesti??n, de Investigaci??n y de Colaboraci??n en Eventos 
                    Acad??micos **
                </td>
                <td class="text-center">{{$formulario->actividades == 'Direcci??n de ramas de organizaciones estudiantiles acad??micas' ? 'X' : ''}}</td>
                <td>Direcci??n de ramas de organizaciones estudiantiles acad??micas</td>
            </tr>
            <tr>
                <td class="text-center">{{$formulario->actividades == 'Represantaci??n Estudiantil' ? 'X' : ''}}</td>
                <td>Representaci??n Estudiantil</td>
                <td>{{$formulario->actividades == 'Representaci??n de la Instituci??n en competencias acad??micas' ? 'X' : ''}}</td>
                <td>Representaci??n de la Instituci??n en competencias acad??micas</td>
            </tr>
            <tr>
                <td class="text-center">{{$formulario->actividades == 'Estudiantes Mentores' ? 'X' : ''}}</td>
                <td>Estudiantes mentores</td>
                <td class="text-center">{{$formulario->actividades == 'Coro y Grupo de C??mara' ? 'X' : ''}}</td>
                <td>Coro y Grupo de C??mara</td>
            </tr>
            <tr>
                <td class="text-center">{{$formulario->actividades == 'Representaci??n de la Instituci??n de competencias deportivas' ? 'X' : ''}}</td>
                <td>
                    Representaci??n de la Instituci??n en competencias 
                    deportivas
                </td>
                <td class="text-center">{{$formulario->actividades == 'Participaci??n en la direcci??n de asociaciones de estudiantes' ? 'X' : ''}}</td>
                <td>Participaci??n en la direcci??n de asociaciones de estudiantes</td>
            </tr>
            <tr>
                <td class="text-center">{{$formulario->actividades == 'Actividades solidarias y de cooperaci??n' ? 'X' : ''}}</td>
                <td>Actividades solidarias y de cooperaci??n</td>
                <td class="text-center">{{$formulario->actividades == 'Participaci??n en juntas receptoras del voto' ? 'X' : ''}}</td>
                <td>Participaci??n en juntas receptoras del voto</td>
            </tr>
            <tr>
                <td class="text-center">{{$formulario->actividades == 'Experiencia Laboral' ? 'X' : ''}}</td>
                <td>Experiencia Laboral</td>
                <td class="text-center"></td>
                <td></td>
            </tr>    
        </table>
        <!--FIN ACTIVIDADES PARA LAS QUE SOLICITA LA CONVALIDACI??N -->
        <div class="mt-10 font-bold bg-success2">
            2. DATOS DEL ESTUDIANTE
        </div>
        <table style="width:100%" class="table table-bordered">
        <tr>
            <td style="width: 20%">Nombres y Apellidos:</td>
            <td style="width: 80%" colspan="5">{{$estudiante->nombres}} {{$estudiante->apellidos}}</td>
        </tr>
        <tr>
            <td style="width: 20%">C??dula de Identidad:</td>
            <td style="width: 80%" colspan="5">{{$estudiante->cedula}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Correo electr??nico:</td>
            <td style="width: 40%">{{$estudiante->correo}}</td>
            <td style="width: 10%">Tel??fono: </td>
            <td style="width: 10%">{{$estudiante->telefono}}</td>
            <td style="width: 10%">Celular:</td>
            <td style="width: 10%">{{$estudiante->celular}}</td>
        </tr>
    </table>
    <div class="mt-10 font-bold bg-success2">
        3. DOCUMENTACI??N DE SOPORTE ADJUNTA
    </div>
    <table style="width:100%" class="table table-bordered">
        <tr>
            <td style="width: 100%">Lista de Documentos subidos:
         <br>
           {{-- INFORMACION DE SOPORTE ADJUNTADA --}}

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
            </td>
        </tr>
    </table>
    <div class="mt-10 font-bold bg-success2">
        4. INFORMACI??N DE LA INSTITUCI??N EN LA QUE REALIZ?? LAS ACTIVIDADES
    </div>
    <table style="width:100%" class="table table-bordered">
        <tr>
            <td style="width: 20%">Raz??n Social *:</td>
            <td style="width: 80%" colspan="5">{{$formulario->razon_social_institucion}}</td>
        </tr>
        <tr>
            <td style="width: 20%">RUC *:</td>
            <td style="width: 80%" colspan="5">{{$formulario->ruc_institucion}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Direcci??n *:</td>
            <td style="width: 80%" colspan="5">{{$formulario->direccion_institucion}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Ciudad/Pa??s:</td>
            <td style="width: 40%">{{$formulario->ciudad_pais_institucion}}</td>
            <td style="width: 10%">Tel??fono: </td>
            <td style="width: 10%">{{$formulario->telefono_institucion}}</td>
            <td style="width: 10%">Celular:</td>
            <td style="width: 10%">{{$formulario->celular_institucion}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Correo electr??nico:</td>
            <td style="width: 80%" colspan="5">{{$formulario->correo_institucion}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Tipo de Instituci??n:</td>
            <td style="width: 80%" colspan="5">{{$formulario->tipo_institucion2}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Campo Amplio:</td>
            <td style="width: 80%" colspan="5">{{$formulario->campo_amplio_institucion}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Campo Espec??fico:</td>
            <td style="width: 80%" colspan="5">{{$formulario->campo_especifico_institucion}}</td>
        </tr>
        <tr>
            <td style="width: 20%">C??digo de Proyecto/Convenio:</td>
            <td style="width: 20%">{{$formulario->codigo_proyecto_convenio}}</td>
            <td style="width: 20%">Nombre del Proyecto/Convenio: </td>
            <td style="width: 20%" colspan="1">{{$formulario->nombre_proyecto_convenio}}</td>
        </tr>
    </table>  
    <div class="mt-10 font-bold bg-success2">
        5. INFORMACI??N DE LAS ACTIVIDADES REALIZADAS
    </div>
    <table style="width:100%" class="table table-bordered">
        <tr>
            <td>Breve resumen de las actividades realizadas:</td>
        </tr>
        <tr>
            <td style="height:30px">{{$formulario->resumen_actividades}}</td>
        </tr>
        <tr>
            <td>??De qu?? manera las actividades realizadas contribuyeron al perfil de egreso de su carrera?</td>
        </tr>
        <tr>
            <td style="height:30px">{{$formulario->actividades_realizadas}}</td>
        </tr>
        <tr>
            <td>??A qu?? resultados de aprendizaje del perfil de egreso considera que aportaron las actividades realizadas?</td>
        </tr>
        <tr>
            <td style="height:30px">{{$formulario->aprendizaje_perfil}}</td>
        </tr>
        <tr>
            <td>??Cu??les son las asignaturas de la malla curricular y las tem??ticas de mayor utilidad para el desarrollo de las actividades?</td>
        </tr>
        <tr>
            <td style="height:30px">{{$formulario->malla_curricular}}</td>
        </tr>
    </table>
    <div class="mt-10 font-bold bg-success2">
        6. INFORMACI??N ADICIONAL
    </div>
    <table style="width:100%" class="table table-bordered">
        <tr>
            <td colspan="4">Informaci??n de las fechas en las que realiz?? las actividades</td>
        </tr>
        <tr>
            <td style="width: 25%">Fecha inicio:</td>
            <td style="width: 25%">{{$formulario->fecha_inicio_actividades}}</td>
            <td style="width: 25%">Fecha fin:</td>
            <td style="width: 25%">{{$formulario->fecha_fin_actividades}}</td>
        </tr>
        <tr>
            <td colspan="4">Horas solicitadas ***: {{$formulario->horas_solicitadas}}
            <br>
        {{-- DOCUMENTACI??N ADICIONAL --}}
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
        </div></td>
            
        </tr>
        <tr>
            
        </tr>
        
    </table>

    <div class="mt-10 font-bold bg-success2">
        7. DECLARACI??N
    </div>
    <table style="width:100%" class="table table-bordered">
        <tr>
            <td style="width: 100%" colspan="4">Yo, {{$estudiante->nombres}} {{$estudiante->apellidos}}, declaro que la informaci??n presentada para la convalidaci??n de pr??cticas preprofesionales es ver??dica.</td>
        </tr>
        <tr style="border: none">
            <td style="width: 15%">Fecha:</td>
            <td style="width: 40%">{{$formulario->fecha_declaracion}}</td>
            <td style="width: 20%">Firma:</td>
            <td style="width: 25%"><img style="max-width:30%;width:auto;height:auto;" src="http://cppp.test{{$formulario->firma_declaracion}}" alt=""></td>
        </tr>
    </table>

    <div class="mt-10 font-bold bg-warning">
        8. INFORME DEL TUTOR EPN
    </div>
    <table style="width:100%" class="table table-bordered">
        <tr>
            <td style="width: 15%" colspan="2">Nombre: {{$profesor->nombres}} {{$profesor->apellidos}}</td>
            <td style="width: 10%"> </td>
            <td style="width: 10%">Departamento:{{$profesor->departamento}}</td>
            <td style="width: 10%"> </td>
        </tr>
        <tr>
            <td style="width: 60%">
                ??Considera que las actividades reportadas contribuyeron a la aplicaci??n de 
                conocimientos o al desarrollo de competencias en la formaci??n del estudiante?
            </td>
            <td style="width: 10%">SI:</td>
            <td style="width: 10%">{{$formulario->inf_tutor_Q1 == 'Si' ? 'X' : ''}}</td>
            <td style="width: 10%">NO:</td>
            <td style="width: 10%">{{$formulario->inf_tutor_Q1 == 'No' ? 'X' : ''}}</td>
        </tr>
        <tr>
            <td style="width: 60%">
                ??Considera que las actividades reportadas contribuyeron a la consecuci??n de 
                los resultados del aprendizaje del perfil de egreso? 
            </td>
            <td style="width: 10%">SI:</td>
            <td style="width: 10%">{{$formulario->inf_tutor_Q2 == 'Si' ? 'X' : ''}}</td></td>
            <td style="width: 10%">NO:</td>
            <td style="width: 10%">{{$formulario->inf_tutor_Q2 == 'No' ? 'X' : ''}}</td></td>
        </tr>
        <tr>
            <td style="width: 60%">
                ??Valid?? las actividades reportadas por el estudiante? 
            </td>
            <td style="width: 10%">SI:</td>
            <td style="width: 10%">{{$formulario->inf_tutor_Q3 == 'Si' ? 'X' : ''}}</td></td>
            <td style="width: 10%">NO:</td>
            <td style="width: 10%">{{$formulario->inf_tutor_Q3 == 'No' ? 'X' : ''}}</td></td>
        </tr>
        <tr>
            <td colspan="5">
                An??lisis y Recomendaciones respecto de la informaci??n presentada: 
            </td>
        </tr>
        <tr>
            <td style="height:30px" colspan="5">
                {{$formulario->recomendaciones_tutor}}
            </td>
        </tr>
        <tr>
            <td style="height:20px">
                Horas validadas y sugeridas 
                de convalidaci??n: 
            </td>
            <td colspan="4">
                {{$formulario->horas_sugeridas}}
            </td>
        </tr>
    </table>

    <div class="mt-10 font-bold bg-danger">
        9. COMISI??N DE PR??CTICAS PREPROFESIONALES
    </div>
    <table style="width:100%" class="table table-bordered">
        <tr>
            <td style="width: 25%">Horas convalidadas:</td>
            <td style="width: 25%" colspan="3">{{$formulario->horas_convalidades}}</td>
        </tr>
        <tr>
            <td style="width: 25%">Pr??cticas Laborales:</td>
            <td style="width: 25%">{{$formulario->horas_convalidades_practicas}}</td>
            <td style="width: 25%">Servicio Comunitario:</td>
            <td style="width: 25%">{{$formulario->horas_convalidades_comunitario}}</td>
        </tr>
        <tr>
            <td style="width: 25%">Observaciones de la CPP:</td>
            <td style="width: 25%" colspan="3">{{$formulario->observaciones_cpp}}</td>
        </tr>
    </table>

    <div class="mt-10 font-bold">
        10. CERTIFICACIONES
    </div>
    <table style="width:100%" class="table table-bordered">
        <tr>
            <td style="width: 50%" class="text-center">
                <div class="font-bold">
                    TUTOR DE PR??CTICAS PREPROFESIONALES
                </div>
                <div>Fecha de Recepci??n: {{$formulario->fecha_recepcion_tutor}} </div>
                <div>Fecha de Revisi??n: {{$formulario->fecha_revision_tutor}} </div>
                <div><img style="max-width:15%;width:auto;height:auto;" src="http://cppp.test{{$formulario->firma_tutor}}" alt=""></div>
                <div>f. ______________________________</div>
                <div>Tutor</div>
                <div class="text-left">Nombre: {{$profesor->nombres}} {{$profesor->apellidos}}</div>
                <br/>
                <br/>
           </td>
           <td style="width: 50%" class="text-center">
                <div class="font-bold">
                    COMISI??N DE PR??CTICAS PREPROFESIONALES
                </div>
                <div>Fecha de Recepci??n: {{$formulario->fecha_recepcion_cpp}} </div>
                <div>Fecha de Revisi??n: {{$formulario->fecha_revision_cpp}} </div>
                <div><img style="max-width:15%;width:auto;height:auto;" src="http://cppp.test{{$formulario->firma_cpp}}" alt=""></div>
                <div>f. ______________________________</div>
                <div>Presidente</div>
                <div class="text-left">Nombre: {{$comision->name}}</div>
                <br/>
                <br/>
           </td>
        </tr>
        <tr>
        <td class="text-center" colspan="2">
                <div class="font-bold">
                    DECANO(A) DE LA FACULTAD / 
                </div>
                <div class="font-bold">
                    DIRECTOR(A) DE LA ESFOT
                </div>
                <div>Fecha de Recepci??n: {{$formulario->fecha_recepcion_decano}} </div>
                <div>Fecha de Revisi??n: {{$formulario->fecha_autorizacion_decano }} </div>
                <div><img style="max-width:15%;width:auto;height:auto;" src="http://cppp.test{{$formulario->firma_decano}}" alt=""></div>
                <div>f. ______________________________</div>
                <div>Decano (a) / Director (a)</div>
                <div class="text-left">Nombre: {{$decano->name}}</div>
                <br/>
                <br/>
                <div>Fecha de Registro en SAEw:_____________________ Responsable Registro SAEw:_____________________</div>
           </td>
        </tr>
    </table>

    </div>
</div>

</div>

@endsection@stop

@section('css')
    <link rel="stylesheet" href="../css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop