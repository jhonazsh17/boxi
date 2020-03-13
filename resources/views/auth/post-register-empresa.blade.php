@extends('base-other')

@section('contenedor')
<div >
	<br>
	<div class="container">
		<div class="row">
			
			<div class="col-md-12" style="padding-left: 5px">
				<div style="margin-top: 54px">
					<h3>El Siguiente paso es crear tu empresa. </h3>
				</div>
				<div class="panel-customize" style="margin-top: 1em">
					<div class="panel-self-head" style="font-size: 1.2em">
						
						<div class="row">
							<div class="col-md-6">
								<b>Crear Empresa</b>
							</div>
							<div class="col-md-6 text-right">
								<a class="btn btn-default btn-xs" href="{{ url('/administracion') }}">Ir Administración</a>
							</div>
						</div>
					</div>
					<div class="panel-self-body">
						@if(Session::has('msg'))
            			<div class="row">
            				<div class="col-md-12">
            					<div class="alert alert-warning alert-dismissible" style="border-radius: 3px">
					                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="right: 0px">×</button>
					                
					                {{ Session::get('msg') }}
					            </div>
            				</div>
            				
            			</div>	
			            
			            @endif

						{{ Form::open(array('url' => 'empresa/save', 'type'=>'post', 'files' => true)) }}
						<div class="row">

							<div class="col-md-2" style="padding-right: 5px">
								<div class="form-group">
									<label><span class="color-red">*</span> RUC: </label>
									<input type="text" class="form-control form-esp" placeholder="RUC" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" v-model="producto.producto" name="ruc" maxlength="11" @if(Session::has('ruc')) value="{{ Session::get('ruc') }}" @endif>
								</div>
							</div>

							<div class="col-md-6" style="padding-left: 5px; padding-right: 5px">
								<div class="form-group">
									<label><span class="color-red">*</span> Nombre Completo Empresa (Razón Social):</label>
									<input type="text" class="form-control form-esp form-upper" placeholder="Nombre de Empresa" name="razon_social" onkeyup="javascript:this.value=this.value.toUpperCase();" @if(Session::has('razon_social')) value="{{ Session::get('razon_social') }}" @endif>
								</div>
							</div>

							<div class="col-md-4" style="padding-left: 5px">
								<div class="form-group">
									<label>Nombre Comercial:</label>
									<input type="text" class="form-control form-esp form-upper" placeholder="Nombre Comercial de la Empresa" name="nombre_comercial" onkeyup="javascript:this.value=this.value.toUpperCase();" @if(Session::has('nombre_comercial')) value="{{ Session::get('nombre_comercial') }}" @endif>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-2" style="padding-right: 5px;">
								<div class="form-group">
									<label><span class="color-red">*</span> País:</label>
									<select name="pais" id="" class="form-control form-esp form-upper" onchange="javascript:this.value=this.value.toUpperCase();" >
										<option value="Perú">Perú</option>
									</select>
								</div>
							</div>

							<div class="col-md-2" style="padding-left: 5px; padding-right: 5px">
								<div class="form-group">
									<label><span class="color-red">*</span> Departamento:</label>
									
									<select  id="departamento" class="form-control form-esp form-upper" onchange="javascript:this.value=this.value.toUpperCase();" >
										<option value="" disabled selected>Elegir</option>
									</select>

									<input type="hidden" name="departamento" id="de">
								</div>
							</div>

							<div class="col-md-2" style="padding-left: 5px; padding-right: 5px">
								<div class="form-group">
									<label><span class="color-red">*</span> Provincia:</label>
									<select  id="provincia" class="form-control form-esp form-upper" onchange="javascript:this.value=this.value.toUpperCase();">
										<option value="" disabled selected>Elegir</option>
									</select>
									<input type="hidden" name="provincia" id="p">
								</div>
							</div>

							<div class="col-md-2" style="padding-left: 5px; padding-right: 5px">
								<div class="form-group">
									<label><span class="color-red">*</span> Distrito:</label>
									<select  id="distrito" class="form-control form-esp form-upper" onchange="javascript:this.value=this.value.toUpperCase();">
										<option value="" disabled selected>Elegir</option>
									</select>
									<input type="hidden" name="distrito" id="d">
								</div>
							</div>

							<div class="col-md-4" style="padding-left: 5px">
								<div class="form-group">
									<label><span class="color-red">*</span> Dirección de Empresa:</label>
									<input type="text" class="form-control form-esp form-upper" placeholder="Dirección de la Empresa" name="direccion" onkeyup="javascript:this.value=this.value.toUpperCase();" @if(Session::has('direccion')) value="{{ Session::get('direccion') }}" @endif>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12" style="margin-bottom: 1em">
								<label>Descripción:</label> <small style="color:#969696">(<span id="cantDesc">0</span> / 480)</small>
								<textarea name="descripcion" id="dscrp"  rows="4" class="form-control form-upper" placeholder="Ingresar Descripción ..."  onkeyup="getSizeCharacter(this.value.toUpperCase(), '#cantDesc')" maxlength="480" >@if(Session::has('descripcion')) {{ Session::get('descripcion') }} @endif</textarea>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6" style="padding-right: 5px">
								<div class="form-group">
									<label>Visión:</label> <small style="color:#969696">(<span id="cantVi">0</span> / 140)</small>
									<textarea name="vision" id="visi"  rows="3" class="form-control form-esp form-upper" placeholder="Ingresar Visión ..." onkeyup="getSizeCharacter(this.value.toUpperCase(), '#cantVi',)" maxlength="140" >@if(Session::has('vision')) {{ Session::get('vision') }} @endif</textarea>
								</div>
							</div>

							<div class="col-md-6" style="padding-left: 5px">
								<div class="form-group">
									<label>Misión:</label> <small style="color:#969696">(<span id="cantMi">0</span> / 140)</small>
									<textarea name="mision" id="misi"  rows="3" class="form-control form-esp form-upper" placeholder="Ingresar Misión ..." onkeyup="getSizeCharacter(this.value.toUpperCase(), '#cantMi')" maxlength="140" >@if(Session::has('mision')) {{ Session::get('mision') }} @endif</textarea>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12" >
								<div class="form-group">
									<label>Logo de la Empresa:</label> <small style="color:#969696">Es preferible que el nombre de archivo del logo sea un nombre entendible.</small>
									<input type="file" class="form-control form-esp form-upper" name="logo" >
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<button class="btn btn-default" id="save_empresa">Guardar Empresa</button>

								<a class="btn btn-sad" href="{{ url('/administracion') }}">Omitir</a>

							</div>
						</div>
						{{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	
	
@endsection
@section('scripts')
<script src="{{ asset('js/ubigeo.js') }}"></script>
<script>
	var ubigeo = window.ubigeo;

	var departamentos = ubigeo.departamentos;
	var distritos     = ubigeo.distritos;
	var provincias    = ubigeo.provincias;

	for (var i = 0; i < departamentos.length; i++) {
		$('#departamento').append("<option value='"+departamentos[i]['id_ubigeo']+"'>"+departamentos[i]['nombre_ubigeo']+"</option>");
	}

	$('#departamento').change(function(){
		$('#provincia').html('');
		provs = provincias[$('#departamento').val()];
		$('#provincia').append('<option value="" disabled selected>Elegir</option>');
		for (var i = 0; i < provs.length; i++) {
			$('#provincia').append("<option value='"+provs[i]['id_ubigeo']+"'>"+provs[i]['nombre_ubigeo']+"</option>");
		}

		for (var i = 0; i < departamentos.length; i++) {
			if(departamentos[i]['id_ubigeo']==$('#departamento').val()){
				$('#de').val(departamentos[i]['nombre_ubigeo']);
			}
		}
	});

	$('#provincia').change(function(){
		$('#distrito').html('');
		dists = distritos[$('#provincia').val()];
		$('#distrito').append('<option value="" disabled selected>Elegir</option>');
		for (var i = 0; i < dists.length; i++) {
			$('#distrito').append("<option value='"+dists[i]['id_ubigeo']+"'>"+dists[i]['nombre_ubigeo']+"</option>");
		}

		for (var i = 0; i < provs.length; i++) {
			if(provs[i]['id_ubigeo']==$('#provincia').val()){
				$('#p').val(provs[i]['nombre_ubigeo']);
			}
		}
	});

	$('#distrito').change(function(){
		
		for (var i = 0; i < dists.length; i++) {
			if(dists[i]['id_ubigeo']==$('#distrito').val()){
				$('#d').val(dists[i]['nombre_ubigeo']);
			}
		}
	});


</script>

<script>
	function getSizeCharacter(value, eShowSize){
			
		$(eShowSize).text(value.length);
				
	}

	$('form').keyup(function(e){
		if(e.wich==13){	
			$('#saveEmpresa').attr('disabled');
		}
	});

	$('#save_empresa').click(function(){
		console.log('hola');	
		$(this).attr('disabled');
				
	});
</script>

@endsection
