<!DOCTYPE html>
<html>
<head>
    <title>Generar PDF</title>
<style>
.page_break {
  page-break-before: always;
}
body {
    margin-right: 20px;
    margin-top: 30px;
    margin-bottom: 40px; 
    font: 'sans-serif';
}
.f-left {
    float: left; 
}

.c-left{
    clear:left
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

.font-bold{
    font-weight: bold;
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

.bg-info{
    background-color: rgb(221, 235, 247);
}

.bg-success{
    background-color: rgb(198, 224, 180);
}

.bg-warning{
    background-color: rgb(255, 230, 153);
}

.bg-danger{
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
</head>
<body>
    <div>    
        <div class="div1 f-left"><img src="data:image/png;base64,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" width="25px" alt="Logo Universidad"/></div>
        <!-- <div class="div1 f-left"><img src="C:\xampp\htdocs\university\university\storage\app\logo.jpeg" width="40px" alt="Logo Universidad"/></div> -->
        <div class="div2 f-left">
            <p class="line-height-none font-bold font-14 text-center">ESCUELA POLITÉCNICA NACIONAL</p>
            <p class="line-height-none font-bold font-12 text-center">FACULTAD DE CIENCIAS</p>
        </div>
        <div class="div3 pl-10">
            <div class="f-left magin">   
                <div class="uppercase font-bold font-14">Formulario</div>
                <div class="font-bold">Versión</div>
            </div>
            <div class="f-left">
                <div class="uppercase font-bold text-red font-14 ml-20">{{$formulario}}</div>
                <div class="text-right font-bold font-14">{{$version}}</div>
            </div>        
        </div> 
    </div>  
    <div class="c-left">
        <div class="font-bold font-14 f-left w-20porc">
            CARRERA:
        </div>
        <div class="f-left bg-info w-80porc font-bold">
            {{$carrera}}
        </div>
    </div>
    <div class="c-left mt-40">
        <div class="font-bold font-14 text-center">
            CONVALIDACIÓN DE PRÁCTICAS PREPROFESIONALES
        </div>
        <div class="font-bold font-10 mt-30">
            SECCIONES A SER LLENADAS POR CADA RESPONSABLE:
        </div>
        <div class="font-bold font-10 bg-success w-1d3">
            Estudiante (resaltadas en verde)
        </div>
        <div class="font-bold font-10 bg-warning w-1d3">
            Tutor (resaltada en amarillo)
        </div>
        <div class="font-bold font-10 bg-danger w-1d3">
            CPP (resaltada en anaranjado)
        </div>
    </div>

    <div class="mt-10 font-12 font-bold bg-success">
        1. ACTIVIDADES PARA LAS QUE SOLICITA LA CONVALIDACIÓN
    </div>
    <table style="width:100%" class="font-10 font-bold">
        <tr>
            <td style="width: 10%" class="text-center">{{$actividades == 'Cursos y Seminarios Profesionales' ? 'X' : ''}}</td>
            <td style="width: 35%">Cursos y Seminarios Profesionales</td>
            <td style="width: 10%" class="text-center">{{$actividades == 'Idiomas diferentes al Inglés y Lengua Materna' ? 'X' : ''}}</td>
            <td style="width: 45%">Idiomas diferentes al Inglés y Lengua Materna</td>
        </tr>
        <tr>
            <td class="text-center">{{$actividades == 'Participación Estudiantil en Actividades Académicas, de Gestión, de Investigación y de Colaboración en Eventos Académicos **' ? 'X' : ''}}</td>
            <td>
                Participación Estudiantil en Actividades Académicas, de 
                Gestión, de Investigación y de Colaboración en Eventos 
                Académicos **
            </td>
            <td class="text-center">{{$actividades == 'Dirección de ramas de organizaciones estudiantiles académicas' ? 'X' : ''}}</td>
            <td>Dirección de ramas de organizaciones estudiantiles académicas</td>
        </tr>
        <tr>
            <td class="text-center">{{$actividades == 'Representación Estudiantil' ? 'X' : ''}}</td>
            <td>Representación Estudiantil</td>
            <td>{{$actividades == 'Representación de la Institución en competencias académicas' ? 'X' : ''}}</td>
            <td>Representación de la Institución en competencias académicas</td>
        </tr>
        <tr>
            <td class="text-center">{{$actividades == 'Estudiantes mentores' ? 'X' : ''}}</td>
            <td>Estudiantes mentores</td>
            <td class="text-center">{{$actividades == 'Coro y Grupo de Cámara' ? 'X' : ''}}</td>
            <td>Coro y Grupo de Cámara</td>
        </tr>
        <tr>
            <td class="text-center">{{$actividades == 'Representación de la Institución en competencias deportivas' ? 'X' : ''}}</td>
            <td>
                Representación de la Institución en competencias 
                deportivas
            </td>
            <td class="text-center">{{$actividades == 'Participación en la dirección de asociaciones de estudiantes' ? 'X' : ''}}</td>
            <td>Participación en la dirección de asociaciones de estudiantes</td>
        </tr>
        <tr>
            <td class="text-center">{{$actividades == 'Actividades solidarias y de cooperación' ? 'X' : ''}}</td>
            <td>Actividades solidarias y de cooperación</td>
            <td class="text-center">{{$actividades == 'Participación en juntas receptoras del voto' ? 'X' : ''}}</td>
            <td>Participación en juntas receptoras del voto</td>
        </tr>
        <tr>
            <td class="text-center">{{$actividades == 'Experiencia Laboral' ? 'X' : ''}}</td>
            <td>Experiencia Laboral</td>
            <td class="text-center"></td>
            <td></td>
        </tr>    
    </table>
    <div class="mt-10 font-12 font-bold bg-success">
        2. DATOS DEL ESTUDIANTE
    </div>
    <table style="width:100%" class="font-10 font-bold">
        <tr>
            <td style="width: 20%">Nombres y Apellidos:</td>
            <td style="width: 80%" colspan="5">{{$nombre_estudiante}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Cédula de Identidad:</td>
            <td style="width: 80%" colspan="5">{{$cedula_estudiante}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Correo electrónico:</td>
            <td style="width: 40%">{{$correo_estudiante}}</td>
            <td style="width: 10%">Teléfono: </td>
            <td style="width: 10%">{{$telefono_estudiante}}</td>
            <td style="width: 10%">Celular:</td>
            <td style="width: 10%">{{$celular_estudiante}}</td>
        </tr>
    </table>
    <div class="mt-10 font-12 font-bold bg-success">
        3. DOCUMENTACIÓN DE SOPORTE ADJUNTA
    </div>
    <table style="width:100%" class="font-10 font-bold">
        <tr>
            <td style="width: 100%">Lista de Documentos subidos:</td>
        </tr>
    </table>
    <div class="mt-10 font-12 font-bold bg-success">
        4. INFORMACIÓN DE LA INSTITUCIÓN EN LA QUE REALIZÓ LAS ACTIVIDADES
    </div>
    <table style="width:100%" class="font-10 font-bold">
        <tr>
            <td style="width: 20%">Razón Social *:</td>
            <td style="width: 80%" colspan="5">{{$nombre_estudiante}}</td>
        </tr>
        <tr>
            <td style="width: 20%">RUC *:</td>
            <td style="width: 80%" colspan="5">{{$cedula_estudiante}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Dirección *:</td>
            <td style="width: 80%" colspan="5">{{$cedula_estudiante}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Ciudad/País:</td>
            <td style="width: 40%">{{$correo_estudiante}}</td>
            <td style="width: 10%">Teléfono: </td>
            <td style="width: 10%">{{$telefono_estudiante}}</td>
            <td style="width: 10%">Celular:</td>
            <td style="width: 10%">{{$celular_estudiante}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Correo electrónico:</td>
            <td style="width: 80%" colspan="5">{{$cedula_estudiante}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Tipo de Institución:</td>
            <td style="width: 80%" colspan="5" class="bg-info">{{$cedula_estudiante}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Campo Amplio:</td>
            <td style="width: 80%" colspan="5" class="bg-info">{{$cedula_estudiante}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Campo Específico:</td>
            <td style="width: 80%" colspan="5" class="bg-info">{{$cedula_estudiante}}</td>
        </tr>
        <tr>
            <td style="width: 20%">Ciudad/País:</td>
            <td style="width: 20%">{{$correo_estudiante}}</td>
            <td style="width: 20%">Teléfono: </td>
            <td style="width: 20%">{{$telefono_estudiante}}</td>
            <td style="width: 20%" colspan="2">Celular:</td>
        </tr>
    </table>   
    <div class="font-10 cursiva">
        * En el caso de que la Razón Social corresponda a un organismo internacional (Coursera, Edx u otras plataformas) colocar N/A (No Aplica).
    </div>
    <div class="font-10 cursiva">
        ** En caso de que las actividades sean bajo Convenios o Proyectos, indicar el código y nombre del convenio o proyecto. 
    </div>
    <div class="mt-10 font-12 font-bold bg-success">
        5. INFORMACIÓN DE LAS ACTIVIDADES REALIZADAS
    </div>
    <table style="width:100%" class="font-10 font-bold">
        <tr>
            <td>Breve resumen de las actividades realizadas:</td>
        </tr>
        <tr>
            <td style="height:30px"></td>
        </tr>
        <tr>
            <td>¿De qué manera las actividades realizadas contribuyeron al perfil de egreso de su carrera?</td>
        </tr>
        <tr>
            <td style="height:30px"></td>
        </tr>
        <tr>
            <td>¿A qué resultados de aprendizaje del perfil de egreso considera que aportaron las actividades realizadas?</td>
        </tr>
        <tr>
            <td style="height:30px"></td>
        </tr>
        <tr>
            <td>¿Cuáles son las asignaturas de la malla curricular y las temáticas de mayor utilidad para el desarrollo de las actividades?</td>
        </tr>
        <tr>
            <td style="height:30px"></td>
        </tr>
    </table>
    <div class="page_break">

    </div>
    <div class="mt-10 font-12 font-bold bg-success">
        6. INFORMACIÓN ADICIONAL
    </div>
    <table style="width:100%" class="font-10 font-bold">
        <tr>
            <td colspan="4">Información de las fechas en las que realizó las actividades</td>
        </tr>
        <tr>
            <td style="width: 25%">Fecha inicio:</td>
            <td style="width: 25%"></td>
            <td style="width: 25%">Fecha fin:</td>
            <td style="width: 25%"></td>
        </tr>
        <tr>
            <td colspan="4">Horas solicitadas ***:</td>
        </tr>
    </table>
    <div class="font-10 cursiva">
        *** En el caso de actividades con horarios flexibles, detallar los horarios de trabajo y adjuntar el registro de asistencia y actividades. 
    </div>
    <div class="mt-10 font-12 font-bold bg-success">
        7. DECLARACIÓN
    </div>
    <table style="width:100%" class="font-10 font-bold">
        <tr>
            <td style="width: 100%" colspan="4">Yo, NOMBRE_ESTUDIANTE, declaro que la información presentada para la convalidación de prácticas preprofesionales es verídica.</td>
        </tr>
        <tr style="border: none">
            <td style="width: 15%">Fecha:</td>
            <td style="width: 40%">dd/mm/aaaa</td>
            <td style="width: 20%">Firma:</td>
            <td style="width: 25%"></td>
        </tr>
    </table>
    <div class="mt-10 font-12 font-bold bg-warning">
        8. INFORME DEL TUTOR EPN
    </div>
    <table style="width:100%" class="font-10 font-bold">
        <tr>
            <td style="width: 15%" colspan="2">Nombre:</td>
            <td style="width: 20%"></td>
            <td style="width: 20%">Departamento:</td>
            <td style="width: 45%"></td>
        </tr>
        <tr>
            <td style="width: 60%">
                ¿Considera que las actividades reportadas contribuyeron a la aplicación de 
                conocimientos o al desarrollo de competencias en la formación del estudiante?
            </td>
            <td style="width: 10%">SI:</td>
            <td style="width: 10%"></td>
            <td style="width: 10%">NO:</td>
            <td style="width: 10%"></td>
        </tr>
        <tr>
            <td style="width: 60%">
                ¿Considera que las actividades reportadas contribuyeron a la consecución de 
                los resultados del aprendizaje del perfil de egreso? 
            </td>
            <td style="width: 10%">SI:</td>
            <td style="width: 10%"></td>
            <td style="width: 10%">NO:</td>
            <td style="width: 10%"></td>
        </tr>
        <tr>
            <td style="width: 60%">
                ¿Validó las actividades reportadas por el estudiante? 
            </td>
            <td style="width: 10%">SI:</td>
            <td style="width: 10%"></td>
            <td style="width: 10%">NO:</td>
            <td style="width: 10%"></td>
        </tr>
        <tr>
            <td colspan="5">
                Análisis y Recomendaciones respecto de la información presentada: 
            </td>
        </tr>
        <tr>
            <td style="height:30px" colspan="5"> 
            </td>
        </tr>
        <tr>
            <td style="height:20px">
                Horas validadas y sugeridas 
                de convalidación: 
            </td>
            <td colspan="4">

            </td>
        </tr>
    </table>
    <div class="mt-10 font-12 font-bold bg-danger">
        9. COMISIÓN DE PRÁCTICAS PREPROFESIONALES
    </div>
    <table style="width:100%" class="font-10 font-bold">
        <tr>
            <td style="width: 25%">Horas convalidadas:</td>
            <td style="width: 25%" colspan="3"></td>
        </tr>
        <tr>
            <td style="width: 25%">Prácticas Laborales:</td>
            <td style="width: 25%"></td>
            <td style="width: 25%">Servicio Comunitario:</td>
            <td style="width: 25%"></td>
        </tr>
        <tr>
            <td style="width: 25%">Observaciones de la CPP:</td>
            <td style="width: 25%" colspan="3"></td>
        </tr>
    </table>
    <div class="mt-10 font-12 font-bold">
        10. CERTIFICACIONES
    </div>
    <table style="width:100%" class="font-10">
        <tr>
            <td style="width: 50%" class="text-center">
                <div class="font-bold">
                    TUTOR DE PRÁCTICAS PREPROFESIONALES
                </div>
                <div>Fecha de Recepción:  DD/MM/AAAA</div>
                <div>Fecha de Revisión:  DD/MM/AAAA</div>
                <br/>
                <br/>
                <div>f. ______________________________</div>
                <div>Tutor</div>
                <div class="text-left">Nombre:</div>
                <br/>
                <br/>
           </td>
           <td style="width: 50%" class="text-center">
                <div class="font-bold">
                    COMISIÓN DE PRÁCTICAS PREPROFESIONALES
                </div>
                <div>Fecha de Recepción:  DD/MM/AAAA</div>
                <div>Fecha de Revisión:  DD/MM/AAAA</div>
                <br/>
                <br/>
                <div>f. ______________________________</div>
                <div>Presidente</div>
                <div class="text-left">Nombre:</div>
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
                <div>Fecha de Recepción:  DD/MM/AAAA</div>
                <div>Fecha de Revisión:  DD/MM/AAAA</div>
                <br/>
                <br/>
                <div>f. ______________________________</div>
                <div>Decano (a) / Director (a)</div>
                <div class="text-left">Nombre:</div>
                <br/>
                <br/>
                <div>Fecha de Registro en SAEw: DD/MM/AAAA Responsable Registro SAEw: Nombre</div>
           </td>
        </tr>
    </table>
</body>
</html>