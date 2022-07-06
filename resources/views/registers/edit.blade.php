@extends('adminlte::page')

@section('title', 'Edit')

@section('content_header')
    <h1>Editar Registro</h1>
@stop

@section('content')

	@if(session('Info'))
		<div class="alert alert-success">
			<strong>{{ session('Info') }}</strong>
		</div>
	@endif
	
    <div class="container-fluid">

		<div class="mb-3">
			<h5 class="h5 d-inline align-middle"><b>{{ $registro->datosestudiante->estudiante->nombres}} {{$registro->datosestudiante->estudiante->apellidos }}</b>
				<br> {{ $registro->datosestudiante->tipopractica->TipoPracticas }} 
				<br> Registro Nº: {{ $registro->datosestudiante->id }} 
				</h5>
		</div>

			
			<form action="{{ route('registros.update',$registro->id) }}" method="post">

				@csrf
				@method('put')		

					@can('Fechas_Detalle')
					
					
					@if($registro->datosempresa->empresaproyecto->Empresa_Proyecto)

					<div class="row">
						<div class="col-12 col-lg-6">
							<h4 class="card-title mb-0"><b>Datos de Empresa/Proyecto</b> (Modificado: {{ $registro->datosempresa->updated_at}})</h4><br>
						</div>
					</div>

					<div class="row">

						<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Tutor Empresa/Proyecto</h5>
								</div>
								<div class="card-body">
									<input type="text" class="form-control" name="Tutor_EP"  placeholder='{{$registro->datosempresa->Tutor_EP}}'>
								</div>
							</div>
						</div>
					</div>				

					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">E-mail</h5>
								</div>
								<div class="card-body">
									<input type="text" class="form-control" name="email" placeholder='{{ $registro->datosempresa->E_Mail }}'>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Teléfono:</h5>
								</div>
								<div class="card-body">
									<input type="text" class="form-control" name="telf" placeholder='{{ $registro->datosempresa->Telf }}'>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Celular:</h5>
								</div>
								<div class="card-body">
									<input type="text" class="form-control" name="cel" placeholder='{{ $registro->datosempresa->Cel }}'>
								</div>
							</div>
						</div>
					</div>
					@endif
					@if($registro->datosconvalidacion->tipoconvalidacion->Tipo_Convalidacion)
					<div class="row">
						<div class="col-12 col-lg-6">
							<h4 class="card-title mb-0" align="left"><b>Datos de Convalidación</b> (Modificado:{{ $registro->datosconvalidacion->updated_at}})</h4><br>
						</div>
					</div>
					<div class="card">
						<div class="card-header">
							<h5 class="card-title mb-0">Detalle de convalidación</h5>
						</div>
						<div class="card-body">
							<input type="text" class="form-control" name="detail" placeholder="{{ $registro->datosconvalidacion->Detalle }}">
						</div>
					</div>

					@endif

					@endcan

					<div class="row">
						<div class="col-12 col-lg-6">
							<h4 class="card-title mb-0" align="left"><b>Seguimiento del Trámite</b> (Modificado: {{ $registro->datosseguimiento->updated_at}})</h4><br>
						</div>
					</div>

				
					<div class="row">
						@can('Fechas_Detalle')
							
						<div class="col-12 col-lg-3">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Ingreso de documentos:</h5><br>
										<div class="row justify-content-center">
									        <div class="col-lg-12 col-sm-12" align="center">
									            <input name="ing" id="ing" class="form-control" type="date" value="{{ $registro->datosseguimiento->Fecha_Ingreso }}"/>
									            <span id="ing"></span>
									        </div>
									    </div>  
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Validación de documentos:</h5><br>
										<div class="row justify-content-center">
									        <div class="col-lg-12 col-sm-12" align="center">
									            <input name="val" id="val" class="form-control" type="date" value="{{ $registro->datosseguimiento->Fecha_Val_CPPP }}"/>
									            <span id="val"></span>
									        </div>
									    </div>  
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Entrega de certificado:</h5><br>
										<div class="row justify-content-center">
									        <div class="col-lg-12 col-sm-12" align="center">
									            <input name="cert" id="cert" class="form-control" type="date"  value="{{ $registro->datosseguimiento->Fecha_Cert }}"/>
									            <span id="cert"></span>
									        </div>
									    </div>  
								</div>
							</div>
						</div>
						<div class="col-12 col-lg-3">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Registro en el sistema:</h5><br>
										<div class="row justify-content-center">
									        <div class="col-lg-12 col-sm-12" align="center">
									            <input name="sis" id="sis" class="form-control" type="date" value="{{ $registro->datosseguimiento->Fecha_Reg_Sis }}"/>
									            <span id="sis"></span>
									        </div>
									    </div>  
								</div>
							</div>
						</div>
						@endcan

						@can('Fecha_Ingreso')
						<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Ingreso de documentos:</h5><br>
										<div class="row justify-content-center">
									        <div class="col-lg-12 col-sm-12" align="center">
									            <input name="ing" id="ing" class="form-control" type="date" value="{{ $registro->datosseguimiento->Fecha_Ingreso }}"/>
									            <span id="ing"></span>
									        </div>
									    </div>  
								</div>
							</div>
						</div>	
						@endcan
												

						@can('Fecha_Certificado')
						<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Entrega de certificado:</h5><br>
										<div class="row justify-content-center">
									        <div class="col-lg-12 col-sm-12" align="center">
									            <input name="cert" id="cert" class="form-control" type="date"  value="{{ $registro->datosseguimiento->Fecha_Cert }}"/>
									            <span id="cert"></span>
									        </div>
									    </div>  
								</div>
							</div>
						</div>	
						@endcan
						

						@can('Fecha_Registro')
						<div class="col-12 col-lg-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">Registro en el sistema:</h5><br>
										<div class="row justify-content-center">
									        <div class="col-lg-12 col-sm-12" align="center">
									            <input name="sis" id="sis" class="form-control" type="date" value="{{ $registro->datosseguimiento->Fecha_Reg_Sis }}"/>
									            <span id="sis"></span>
									        </div>
									    </div>  
								</div>
							</div>
						</div>	
						@endcan
						
						
					</div>

					<div class="row">
						<div class="col-12 col-lg-3">
								<div class="card">	
									<input type="submit" class="btn btn-primary" value="Enviar">
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
									<a href="{{ route('registros.index') }}" class="btn btn-primary">Salir</a>
								</div>
									
						</div>
					</div>
			</form>
	</div>

@stop

@section('css')
    <link rel="stylesheet" href="../css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

