<!doctype html>
<html lang="en">

<head>
    <title>Registro{{ $id }}-{{ $Estudiante }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        table {
            font-size: 10px;
            width: 100%;
            border: 1px solid #000;
        }
        th, td {
            width: 25%;
            text-align: left;
            vertical-align: top;
            border: 1px solid #000;
            border-collapse: collapse;
            padding: 0.3em;
            caption-side: bottom;
        }
        caption {
            padding: 0.3em;
            color: #fff;
            background: #000;
        }
        th {
            background: #eee;
        }
        img {
            display: block;
            margin-left: auto;    
            margin-right: auto;
            }
        p {
            font-size: 10px;
        }
        .parent{
        text-align : center;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <h6 class=" font-weight-bold" style="text-align: center">Comisión de Prácticas Pre-profesionales</h6>        
        <h6 class=" font-weight-bold" style="text-align: center">Ingeniería en Telecomunicaciones</h6>
        <div class="parent">
            <img src="{{ asset('img/photos/epn.png') }}" style="width: 70px; height: 70px"><br>
        </div>
        
        
        <p>
        <b>{{ $Estudiante }}</b><br>
        Registro Nº {{ $id }}<br>
        {{ $DateAndTime = date('m-d-Y h:i:s a', time()) }}<br>

        @if ( $Empresa_Proyecto )
            <b>Proceso de Validación:</b> {{ $TipoPractica }}<br>
        @else
            <b>Proceso de Convalidación:</b> {{ $TipoPractica }}<br>    
        @endif
        </p>

        <p><b>DATOS GENERALES</b></p>
        <table class="table table-bordered">
            <thead>             
                <tr>
                    <th style="width:20%">Horas realizadas</th>
                    <th style="width:20%">Fecha de Inicio</th>
                    <th style="width:20%">Fecha de Finalización</th>
                    <th style="width:20%">Periodo</th>
                </tr>
            </thead>
            <tbody>
            
                <tr>
                    <td style="text-align: center">{{ $Horas }}</td> 
                    <td style="text-align: center">{{ $Inicio }}</td> 
                    <td style="text-align: center">{{ $Fin }}</td> 
                    <td style="text-align: center">{{ $Periodo }}</td>   
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <thead>             
                <tr>
                    <th style="width:40%">Tutor FIEE</th>
                    <th style="width:30%">Informe</th>
                    <th style="width:30%">Encuesta</th>
                </tr>
            </thead>
            <tbody>
            
                <tr>
                    <td style="text-align: center">{{ $Tutor_FIEE }}</td>
                    <td style="text-align: center">{{ $Informe }}</td> 
                    <td style="text-align: center">{{ $Encuesta }}</td>    
                </tr>
            </tbody>
        </table>

        @if( $Empresa_Proyecto != 'Sin asignar')
        <p><b>DATOS EMPRESA/PROYECTO</b></p>
        <table class="table table-bordered">
            <thead>             
                <tr>
                    <th style="width:70%">Empresa/Proyecto</th>
                    <th style="width:15%">Convenio</th>
                    <th style="width:15%">Tipo</th>

                </tr>
            </thead>
            <tbody>
            
                <tr>
                    <td style="text-align: center">{{ $Empresa_Proyecto }}</td> 
                    <td style="text-align: center">{{ $Convenio }}</td>   
                    <td style="text-align: center">{{ $Tipo_Empresa }}</td> 
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <thead>             
                <tr>
                    <th style="width:40%">Tutor Empresa/Proyecto</th>
                    <th style="width:20%">E-mail</th>
                    <th style="width:20%">Teléfono</th>
                    <th style="width:20%">Celular</th>
                </tr>
            </thead>
            <tbody>
            
                <tr>
                    <td style="text-align: center">{{ $Tutor_EP }}</td>
                    <td style="text-align: center">{{ $E_Mail }}</td> 
                    <td style="text-align: center">{{ $Telf }}</td> 
                    <td style="text-align: center">{{ $Cel }}</td>   
                </tr>
            </tbody>
        </table>
        @endif

        @if( $Detalle )
        <p><b>DATOS DE CONVALIDACIÓN</b></p>
        <table class="table table-bordered">
            <thead>             
                <tr>
                    <th style="width:40%">Tipo de Convalidación</th>
                    <th style="width:60%">Detalle</th>
                </tr>
            </thead>
            <tbody>
            
                <tr>
                    <td style="text-align: center">{{ $Tipo_Convalidacion }}</td>
                    <td style="text-align: center">{{ $Detalle }}</td> 
 
                </tr>
            </tbody>
        </table>
        @endif

        <p><b>DATOS DE SEGUIMIENTO</b></p>
        <table class="table table-bordered">
            <thead>             
                <tr>
                    <th style="width:25%">Fecha de Ingreso</th>
                    <th style="width:25%">Validación(CPPP)</th>
                    <th style="width:25%">Fecha de certificado</th>
                    <th style="width:25%">Registro SAEw</th>
                </tr>
            </thead>
            <tbody>
            
                <tr>
                    <td style="text-align: center">{{ $Fecha_Ingreso }}</td>
                    <td style="text-align: center">{{ $Fecha_Val_CPPP }}</td> 
                    <td style="text-align: center">{{ $Fecha_Cert }}</td>
                    <td style="text-align: center">{{ $Fecha_Reg_Sis }}</td> 
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered">
            <thead>             
                <tr>
                    <th style="width:40%">Observaciones</th>
                </tr>
            </thead>
            <tbody>
            
                <tr>
                    @if ( $Obs )
                        <td style="text-align: center">{{ $Obs }}</td>
                    @else
                        <td style="text-align: center">No presenta observaciones.</td>
                    @endif
                    
                </tr>
            </tbody>
        </table>

    
    </div>
</body>

</html>