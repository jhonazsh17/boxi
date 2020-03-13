@extends('base-other')

@section('contenedor')
<div>
    <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12" >
                    <div class="panel-boxi">
                        <div class="panel-boxi_head" style="font-size: 1.2em">
                            <div class="row">
                                <div class="col-md-6">
                                    <b>
                                        Crear Empresa
                                    </b>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-sad btn-xs" href="{{ url('/administracion') }}">
                                        <i class="fa fa-arrow-circle-left">
                                        </i>
                                        Volver Administración
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-boxi_body">
                            @if(Session::has('msg'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-warning alert-dismissible" style="border-radius: 3px">
                                        <button aria-hidden="true" class="close" data-dismiss="alert" style="right: 0px" type="button">
                                            ×
                                        </button>
                                        <b>{{ Session::get('msg') }}</b>
                                    </div>
                                </div>
                            </div>
                            @endif

						{{ Form::open(array('url' => 'empresa/save', 'type'=>'post', 'files' => true)) }}

                            <div class="row">
                                <div class="col-md-2" style="padding-right: 7px">
                                    <div class="form-group">
                                        <label>
                                            <span class="color-red">
                                                *
                                            </span>
                                            RUC:
                                        </label>
                                        <input  class="form-control form-esp" maxlength="11" name="ruc" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Consulta RUC" type="text" value="{{ Session::get('ruc') }}" id="evaluaRuc">
                                        <img src="{{ url('img/loading.GIF') }}" id="load-ruc" style='width:25px; position: absolute; z-index: 100; top:29px; right: 15px; display: none'>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding-left: 7px; padding-right: 7px">
                                    <div class="form-group">
                                        <label>
                                            <span class="color-red">
                                                *
                                            </span>
                                            Nombre Completo Empresa (Razón Social):
                                        </label>
                                        <input  class="form-control form-esp form-upper" name="razon_social" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Nombre de Empresa" type="text" value="{{ Session::get('razon_social') }}" id="razon_social">
                                        
                                    </div>
                                </div>
                                <div class="col-md-4" style="padding-left: 7px">
                                    <div class="form-group">
                                        <label>
                                            Nombre Comercial:
                                        </label>
                                        <input class="form-control form-esp form-upper" name="nombre_comercial" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Nombre Comercial de la Empresa" type="text" value="{{ Session::get('nombre_comercial') }}" id="nombre_comercial">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3" style="padding-right: 7px;">
                                    <div class="form-group">
                                        <label>
                                            <span class="color-red">
                                                *
                                            </span>
                                            País:
                                        </label>
                                        <select class="form-control form-esp form-upper" id="" name="pais" onchange="javascript:this.value=this.value.toUpperCase();">
                                            <option value="Perú">
                                                Perú
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding-left: 7px; padding-right: 7px">
                                    <div class="form-group">
                                        <label>
                                            <span class="color-red">
                                                *
                                            </span>
                                            Departamento:
                                        </label>
                                        <select class="form-control form-esp form-upper" id="departamento" onchange="javascript:this.value=this.value.toUpperCase();">
                                            <option disabled="" selected="" value="">
                                                Elegir
                                            </option>
                                        </select>
                                        <input id="de" name="departamento" type="hidden">
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding-left: 7px; padding-right: 7px">
                                    <div class="form-group">
                                        <label>
                                            <span class="color-red">
                                                *
                                            </span>
                                            Provincia:
                                        </label>
                                        <select class="form-control form-esp form-upper" id="provincia" onchange="javascript:this.value=this.value.toUpperCase();">
                                            <option disabled="" selected="" value="">
                                                Elegir
                                            </option>
                                        </select>
                                        <input id="p" name="provincia" type="hidden">
                                    </div>
                                </div>
                                <div class="col-md-3" style="padding-left: 7px;">
                                    <div class="form-group">
                                        <label>
                                            <span class="color-red">
                                                *
                                            </span>
                                            Distrito:
                                        </label>
                                        <select class="form-control form-esp form-upper" id="distrito" onchange="javascript:this.value=this.value.toUpperCase();">
                                            <option disabled="" selected="" value="">
                                                Elegir
                                            </option>
                                        </select>
                                        <input id="d" name="distrito" type="hidden">
                                    </div>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            <span class="color-red">
                                                *
                                            </span>
                                            Dirección de Empresa:
                                        </label>
                                        <input class="form-control form-esp form-upper" name="direccion" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Dirección de la Empresa" type="text" value="{{ Session::get('direccion') }}" id="direccion">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12" style="margin-bottom: 1em">
                                    <label>
                                        Descripción:
                                    </label>
                                    <small style="color:#969696">
                                        (
                                        <span id="cantDesc">
                                            0
                                        </span>
                                        / 480)
                                    </small>
                                    <textarea class="form-control form-upper" id="dscrp" maxlength="480" name="descripcion" onkeyup="getSizeCharacter(this.value.toUpperCase(), '#cantDesc')" placeholder="Ingresar Descripción ..." rows="4">@if(Session::has('descripcion')) {{ Session::get('descripcion') }} @endif</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" style="padding-right: 7px">
                                    <div class="form-group">
                                        <label>
                                            Visión:
                                        </label>
                                        <small style="color:#969696">
                                            (
                                            <span id="cantVi">
                                                0
                                            </span>
                                            / 140)
                                        </small>
                                        <textarea class="form-control form-esp form-upper" id="visi" maxlength="140" name="vision" onkeyup="getSizeCharacter(this.value.toUpperCase(), '#cantVi',)" placeholder="Ingresar Visión ..." rows="3">@if(Session::has('vision')) {{ Session::get('vision') }} @endif</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6" style="padding-left: 7px">
                                    <div class="form-group">
                                        <label>
                                            Misión:
                                        </label>
                                        <small style="color:#969696">
                                            (
                                            <span id="cantMi">
                                                0
                                            </span>
                                            / 140)
                                        </small>
                                        <textarea class="form-control form-esp form-upper" id="misi" maxlength="140" name="mision" onkeyup="getSizeCharacter(this.value.toUpperCase(), '#cantMi')" placeholder="Ingresar Misión ..." rows="3">@if(Session::has('mision')) {{ Session::get('mision') }} @endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>
                                            Logo de la Empresa:
                                        </label>
                                        <small style="color:#969696">
                                            Es preferible que el nombre de archivo del logo sea un nombre entendible.
                                        </small>
                                        <input class="form-control form-esp form-upper" name="logo" type="file">
                                        </input>
                                    </div>
                                </div>
                            </div>
                            
                        </div>

                        <div class="panel-boxi_footer">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button class="btn btn-default" id="save_empresa">
                                        Guardar Empresa
                                    </button>
                                </div>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </br>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/ubigeo.js') }}">
</script>
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

    $('#evaluaRuc').keyup(function(e){
        var cadenaRuc = $(this).val();
        if(cadenaRuc.length==11){
            
            $.ajax({
                url:"/sunat/api",
                data: {ruc:cadenaRuc},
                type:'get',
                dataType:'json',
                beforeSend: function(){
                    $('#load-ruc').show();
                },
                success: function(data){
                    $('#razon_social').val(data['razon_social']);
                    $('#nombre_comercial').val(data['nombre_comercial']);
                    $('#direccion').val(data['domicilio_fiscal']);
                    $('#load-ruc').hide();
                    console.log(data);
                }    
            });
        }else{
            $('#razon_social').val('');
            $('#nombre_comercial').val('');
            $('#direccion').val('');
        }
    });
</script>
@endsection
