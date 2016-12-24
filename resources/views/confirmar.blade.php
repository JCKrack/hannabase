@extends('layouts.dashboard')
@section('page_heading','Promover candidato')
@section('section')
<div class="container-fluid">
	<div class="row">
	<form class="form-horizontal" role="form" method="POST" action="{{ route('convertir_empleado', $empleado->idEmpleado) }}" id="registro-form"  >
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		<div class="panel-body">
			<table class="table table-striped table-bordered table-hover dataTable no-footer" border="2" width="100%" rules="rows" style='text-transform:uppercase'>
			<h4>El siguiente candidato sera promovido a empleado</h4>
			    <tr>
			        <th>ID</th>
			        <th>Nombre</th>
			        <th>CURP</th>
			        <th>IMSS</th>
			        <th>RFC</th>
			        <th><center>Perfil</center></th>
			    </tr>

		        <tr>
		            <td>{{ $empleado->idEmpleado }}</td>
		            <td >{{ $empleado->ap_paterno}} {{ $empleado->ap_materno}} , {{$empleado->nombres}}</td>
		            <td >{{ $empleado->curp}}</td>
		            <td>{{$empleado->imss}}</td>
		            <td>{{$empleado->rfc}}</td>
		            <td ><center> {{ $empleado->tipo_perfil}}</center></td>
		        </tr>
			</table>

			<div class="form-group">
			    <center>
					<button type="submit" class="btn btn-primary" value="validate" style="margin-right: 15px;">
						Convertir
					</button>
				</center>
			</div>
			</div>
			</form>
		</div>
	</div>
</div>

@stop