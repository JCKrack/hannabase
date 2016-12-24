@extends('layouts.dashboard')
@section('page_heading','Nuevo Candidato')
@section('head')
<link rel="stylesheet" href="{{ asset("assets/stylesheets/select2.css") }}" />
@stop
@section('section')

@if(Session::has('success'))
<script type="text/javascript">
window.onload = function(){ alert("¡Candidato registrado exitosamente! ID: {{Session::get('success')}}");}
</script>
@endif

<div class="container-fluid">
	<div class="row">
		<div class="panel panel-primary">
			<div class="panel-heading"><strong>Datos Personales.</strong></div>
			<div class="panel-body">
			@if (count($errors) > 0)
			<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<strong>¡Alerta!</strong> Hubo problemas para registrar al candidato.<br><br> 
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
			@endif
			<form class="form-horizontal" role="form" method="POST" action="{{ route('registro_empleado') }}" id="registro-form" data-parsley-validate="" >
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<!---->
				<div class="row-sm">					
					<p>Campos marcados con <text style="color:red">*</text> son obligatorios.</p>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label class="control-label">Apellido Paterno <text style="color:red">*</text></label>
						<div >
							<input type="text" class="form-control" name="ap_paterno"  id="LettersOnly" onkeypress="return inputLimiter(event,'Letters')" required="" value="{{old('ap_paterno')}}" style="text-transform:uppercase" >
						</div>
					</div>
				    <div class="col-sm-4">
						<label class="control-label">Apellido Materno</label>
						<div >
							<input type="text" class="form-control" name="ap_materno" id="LettersOnly" onkeypress="return inputLimiter(event,'Letters')" value="{{old('ap_materno')}}" style="text-transform:uppercase" >
						</div>
					</div>
					<div class="col-sm-4">
						<label class="control-label">Nombre(s) <text style="color:red">*</text></label>
						<div >
							<input type="text" class="form-control" name="nombres"  id="LettersOnly" onkeypress="return inputLimiter(event,'Letters')" required="" value="{{old('nombres')}}" style="text-transform:uppercase" >
						</div>
					</div>
				</div>
				<!---->
				<hr>
				<div class="row">
					<div class="col-sm-4">
						<label class="control-label">Fecha de nacimiento <text style="color:red">*</text></label>
						<div >
						<input class="form-control" type="date" name="fecha_nacimiento" value="{{old('fecha_nacimiento')}}" required="">
						</div>
					</div>
				    <div class="col-sm-4">
						<label class="control-label">Género <text style="color:red">*</text></label>
						<div >
							<select class="form-control" name="genero">
  								<option value="femenino" @if (Input::old('genero') == 'femenino') selected="" @endif>Femenino</option>
  								<option value="masculino" @if (Input::old('genero') == 'masculino') selected="" @endif>Masculino</option>
							</select>
						</div>
					</div>
					<div class="col-sm-4">
					  <label class="control-label">Estado <text style="color:red">*</text></label>
					  <div >
					  	<select class="form-control" id="estado" name="id_estados" required>
					  		@foreach($datosLocalizacion['estados'] as $estado)
					  			<option value="{{$estado->id_estados}}" @if (Input::old('id_estados') == $estado->id_estados) selected="" @endif>{{$estado->nombre}}</option>
					  		@endforeach
					  	</select>
					  </div>
						
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">
						<label class="control-label">CURP <text style="color:red">*</text></label>
						<div >
							<input type="text" class="form-control" name="curp" required="" maxlength="18" value="{{old('curp')}}" style="text-transform:uppercase" >
							<div class="error"><span class="label label-danger">{{ $errors->first('curp') }}</span></div>
						</div>
					</div>
				    <div class="col-sm-4">
						<label class="control-label">Seguro Social (IMSS)</label>
						<div >
							<input type="text" class="form-control" name="imss" value="{{old('imss')}}" id="NumbersOnly" onkeypress="return inputLimiter(event,'Numbers')"  maxlength="11"  style="text-transform:uppercase" >
							<div class="error"><span class="label label-danger">{{ $errors->first('imss') }}</span></div>
						</div>
					</div>
					   <div class="col-sm-4">
						<label class="control-label">Número de cuenta</label>
						<div >
							<input type="text" class="form-control" name="no_cuenta" value="{{old('no_cuenta')}}" maxlength="10" >
							<div class="error"><span class="label label-danger">{{ $errors->first('no_cuenta') }}</span></div>
						</div>	
					</div>
					<div class="col-sm-4">
						<label class="control-label">RFC</label>
						<div >
							<input type="text" class="form-control" name="rfc" maxlength="13" value="{{old('rfc')}}" style="text-transform:uppercase" >
							<div class="error"><span class="label label-danger">{{ $errors->first('rfc') }}</span></div>
						</div>
					</div>

					<div class="col-sm-4">
						<label class="control-label">Perfil <text style="color:red">*</text></label>
						<div >
							<select class="form-control" name="tipo_perfil">
								<option value="a" @if (Input::old('tipo_perfil') == 'a') selected="" @endif>Tipo A</option>
								<option value="b" @if (Input::old('tipo_perfil') == 'b') selected="" @endif>Tipo B</option>
								<option value="c" @if (Input::old('tipo_perfil') == 'c') selected="" @endif>Tipo C</option>
							</select>
						</div>
						<a href="#perfiles" data-toggle="modal" data-target="#perfiles" style="color:#3af;">Ayúdame a decidir</a>
					</div>
					<div class="col-sm-4">
						<label class="control-label">Visa <text style="color:red">*</text></label>
						<div >
							<select class="form-control" name="visa" required="">
								<option  value="" >Seleccione</option>
								<option value="si" @if (Input::old('visa') == 'si') selected="" @endif>Si</option>
								<option value="no" @if (Input::old('visa') == 'no') selected="" @endif>No</option>
								
							</select>
						</div>
						
					</div>
				</div>

				<div id="perfiles" class="modal fade" role="dialog">
				  <div class="modal-dialog">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Tipos de perfil</h4>
				      </div>
				      <div class="modal-body">
				        <p><strong>Perfil A:</strong> No usa lentes/buena vista, complexió delgada, mínimo secundaria, menor de 40 años, no tatuajes, no aretes y cabello corto.</p>

				        <p><strong>Perfil B:</strong> Visión poco limitada y usa lentes, menor de 45 años, no aretes y cabello corto. Vestimenta normal, complexión poco robusta. Mínimo primaria, que sepa leer y escribir y sin tatuajes visibles.</p>

				        <p><strong>Perfil C:</strong> Menor de 50 años, usa lentes gruesos, aretes en orejas y cejas. Cabello largo, rapado o pelón. Vestimenta suelta. Complexión muy robusta. No sabe leer ni escribir y tiene tatuajes visibles en cara y brazos.</p>
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				      </div>
				    </div>
				  </div>
				</div>
				<hr>
				<h3>Datos de contacto</h3>
				<div class="row">
					<div class="col-sm-4">
						<label class="control-label">Telefono Casa</label>
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-home"></i></span>
						  <input type="text" class="form-control"  name="tel_casa" id="NumbersOnly" onkeypress="return inputLimiter(event,'Numbers')"  maxlength="10" value="{{old('tel_casa')}}">
						</div>
					</div>
				    <div class="col-sm-4">
						<label class="control-label">Telefono Celular</label>
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-mobile fa-2"></i></span>
						  <input type="text"  class="form-control" name="tel_cel" id="NumbersOnly" onkeypress="return inputLimiter(event,'Numbers')" maxlength="10"   value="{{old('tel_cel')}}">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-3">
						<label class="control-label">Calle <text style="color:red">*</text></label>
						<div >
							<input type="text" class="form-control" name="calle" required="" value="{{old('calle')}}" style="text-transform:uppercase" >
						</div>
					</div>
				    <div class="col-sm-3">
						<label class="control-label">No Interior</label>
						<div >
							<input type="text" class="form-control" name="no_interior" value="{{old('no_interior')}}" style="text-transform:uppercase" >
						</div>	
					</div>
					<div class="col-sm-3">
						<label class="control-label">No Exterior <text style="color:red">*</text></label>
						<div >
						<input type="number" class="form-control" name="no_exterior" value="{{old('no_exterior')}}" required="" style="text-transform:uppercase" >
						</div>
					</div>
					<div class="col-sm-3">
						<label class="control-label">Colonia <text style="color:red">*</text></label>
						<div >
							<select class="form-control" id="colonia" name="idColonia" required>
								@foreach($datosLocalizacion['colonias'] as $colonia)
									<option value="{{$colonia->idColonia}}" 
									@if (Input::old('idColonia') == $colonia->idColonia) selected="" @endif>{{$colonia->nombre}}</option>
								@endforeach
							</select>
						</div>		
					</div>
				</div>
				
				<hr>
				<h3>En caso de emergencia</h3>
				<div class="row">
					<div class="col-sm-4">
						<label class="control-label">Nombre <text style="color:red">*</text></label>
						<div >
							<input type="text" class="form-control" name="nombre_contacto"  id="LettersOnly" onkeypress="return inputLimiter(event,'Letters')" required="" value="{{old('nombre_contacto')}}" style="text-transform:uppercase" >
						</div>
					</div>
					<div class="col-sm-4">
						<label class="control-label">Telefono <text style="color:red">*</text></label>
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-phone"></i></span>
						  <input type="text" class="form-control"  name="tel_contacto" id="NumbersOnly" onkeypress="return inputLimiter(event,'Numbers')"  maxlength="10" required="" value="{{old('tel_contacto')}}">
						</div>
					</div>
					<div class="col-sm-4">
						<label class="control-label">Parentesco <text style="color:red">*</text></label>
						<div >
							<select class="form-control" name="tipo_parentesco">
								<option value="esposa" @if (Input::old('tipo_parentesco') == 'esposa') selected="" @endif>Esposa</option>
								<option value="esposo" @if (Input::old('tipo_parentesco') == 'esposo') selected="" @endif>Esposo</option>
								<option value="madre" @if (Input::old('tipo_parentesco') == 'madre') selected="" @endif>Madre</option>
								<option value="padre" @if (Input::old('tipo_parentesco') == 'padre') selected="" @endif>Padre</option>
								<option value="hermana" @if (Input::old('tipo_parentesco') == 'hermana') selected="" @endif>Hermana</option>
								<option value="hermano" @if (Input::old('tipo_parentesco') == 'hermano') selected="" @endif>Hermano</option>
								<option value="tia" @if (Input::old('tipo_parentesco') == 'tia') selected="" @endif>Tia</option>
								<option value="tio" @if (Input::old('tipo_parentesco') == 'tio') selected="" @endif>Tio</option>
								<option value="abuela" @if (Input::old('tipo_parentesco') == 'abuela') selected="" @endif>Abuela</option>
								<option value="abuelo" @if (Input::old('tipo_parentesco') == 'abuelo') selected="" @endif>Abuelo</option>
								<option value="no especificado" @if (Input::old('tipo_parentesco') == 'no especificado') selected="" @endif>No especificado</option>
							</select>
						</div>
					</div>
				</div>
			
				<br>
				<div class="form-group">
				    <center>
						<button type="submit" class="btn btn-primary" value="validate" style="margin-right: 15px;">
							Registro
						</button>
					</center>
				</div>
			</form>
			<!--Fin de Forma -->
			
			<script type="text/javascript">
				function inputLimiter(e,allow) {
			    var AllowableCharacters = '';

			    if (allow == 'Letters'){AllowableCharacters=' ABCDEFGHIJKLMNÑOPQRSTUVWXYZabcdefghijklmnñopqrstuvwxyz';}
			    if (allow == 'Numbers'){AllowableCharacters='1234567890';}
			    if (allow == 'NameCharacters'){AllowableCharacters=' ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz-.\'';}

			    var k = document.all?parseInt(e.keyCode): parseInt(e.which);
			    if (k!=13 && k!=8 && k!=0){
			        if ((e.ctrlKey==false) && (e.altKey==false)) {
			        return (AllowableCharacters.indexOf(String.fromCharCode(k))!=-1);
			        } else {
			        return true;
			        }
			    } else {
			        return true;
			    }
			} 
			</script>
			</div>
		</div>
	</div>
</div>
<!--<script type="text/javascript">
				$(function () {
				  $('#registro-form').parsley().on('field:validated', function() {
				    var ok = $('.parsley-error').length === 0;
				    $('.bs-callout-info').toggleClass('hidden', !ok);
				    $('.bs-callout-warning').toggleClass('hidden', ok);
				  })
				});
			</script>-->

<!--script para busqueda en los select-->

<script type="text/javascript">
	$(document).ready(function() {
		$("#colonia").select2();
		$("#estado").select2();
	});
</script>

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{ asset("assets/scripts/jquery.btechco.excelexport.js") }}" type="text/javascript"></script>
    <script src="{{ asset("assets/scripts/jquery.base64.js") }}" type="text/javascript"></script>


    @stop
@stop