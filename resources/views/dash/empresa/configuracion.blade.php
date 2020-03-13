@extends('base-other')

@section('contenedor')
<div id="config">
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-12" style="padding-left: 5px">
				<div class="panel-boxi">
					<div class="panel-boxi_head" style="font-size: 1.2em">
						<div class="row">
							<div class="col-md-8 font-color-000">
								@if($empresa->logo=="")
									<img src="{{ asset('img') }}/logo-default.png" alt="" width="24px" style="border: 1px solid orange">
								@else
									<img src="{{ asset('uploads/empresas/logo') }}/{{ $empresa->logo }}" alt="" width="24px" style="border: 1px solid orange"> 
								@endif

								@if($empresa->nombre_comercial=="")
									<b>{{ $empresa->razon_social }}</b>: Configuración 
								@else
									<b>{{ $empresa->nombre_comercial }}</b>: Configuración 
								@endif								
							</div>
							<div class="col-md-4 text-right">
								<a class="btn btn-default btn-xs" href="{{ url('/administracion') }}"><i class="fa fa-arrow-circle-left"></i> Volver Administración</a>
							</div>
						</div>
						
					</div>
					<div class="panel-boxi_body supr-padding-top_and_bottom">
						<div class="row">
							<!-- Menu izquierdo -->
							<div class="col-md-2 supr-padding">
								<div class="list-group list-group-customize" style="display:none" v-bind:style="showMenu">
									<a class="list-group-item list-group-customize-item" v-for="itemMenu in menuConfig" v-on:click="onClickItem(itemMenu.idItem)" v-bind:data-item="itemMenu.idItem" ><b>@{{ itemMenu.item }}</b></a>  
								</div>
							</div>
							<!-- Cuerpo -->
							<div class="col-md-10 border-first_left font-color-000" >								
								<div v-show="bodyChoice==1" >
									@include('dash.empresa.templates.informacion')
								</div>
								<div v-show="bodyChoice==7" >									
									@include('dash.empresa.templates.editar_informacion')	
								</div>
								<div v-show="bodyChoice==2" >									
									@include('dash.empresa.templates.usuarios')
								</div>
								<div v-show="bodyChoice==14" >									
									@include('dash.empresa.templates.nuevo_usuario')
								</div>
								<div v-show="bodyChoice==3" >									
									@include('dash.empresa.templates.sucursales')
								</div>
								<div v-show="bodyChoice==9" >									
									@include('dash.empresa.templates.nueva_sucursal')				
								</div>
								<div v-show="bodyChoice==13" >									
									@include('dash.empresa.templates.editar_sucursal')					
								</div>
								<div v-show="bodyChoice==4" >									
									@include('dash.empresa.templates.tipos_inventario')					
								</div>
								<div v-show="bodyChoice==10" >									
									@include('dash.empresa.templates.nuevo_tipo_inventario')
								</div>
								<div v-show="bodyChoice==5" >									
									@include('dash.empresa.templates.categorias')
								</div>
								<div v-show="bodyChoice==11" >									
									@include('dash.empresa.templates.nueva_categoria')
								</div>
								<div v-show="bodyChoice==6" >									
									@include('dash.empresa.templates.unidades')
								</div>
								<div v-show="bodyChoice==12" >									
									@include('dash.empresa.templates.nueva_unidad')
								</div>
								<div v-show="bodyChoice==15" >									
									@include('dash.empresa.templates.configuracion-avanzada')
								</div>
								<div v-show="bodyChoice==16" >									
									@include('dash.empresa.templates.cargos')
								</div>	
								<div v-show="bodyChoice==17" >									
									@include('dash.empresa.templates.nuevo_cargo')
								</div>
								<div v-show="bodyChoice==18" >									
									@include('dash.empresa.templates.editar_usuario')
								</div>									
							</div>
						</div>
					</div>
					<div class="panel-boxi_footer">
						<div class="text-center font-color-ccc">
							Esta sección solo el Administrador de esta Cuenta puede ver.
						</div>
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
	function onClickEditarSucursal(id){
		appConfig.onClickEditarSucursal(id);
	}

	function onClickEditarEmpleado(id){
		appConfig.onClickEditarUsuarioEmpleado(id);
	}

	function getSizeCharacter(value, eShowSize){
			
		$(eShowSize).text(value.length);
				
	}

</script>
<script>
	$('#table-users').DataTable({
                    
                    "order": [[ 3, "desc" ]],
                    "pageLength": 10, 
                    "language":{
                        "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                        "lengthMenu":"Mostrar _MENU_ Usuarios",
                        "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Usuarios",
                        "paginate": {
                            "first":"Primero",
                            "last":"Último",
                            "next":"Siguiente",
                            "previous":"Anterior"
                        },
                        "search":"Buscar:",
                        "emptyTable": "No Hay Usuarios Registrados.",
                    },
                    "destroy":true
                });

	var ubigeo = window.ubigeo;

	var departamentos = ubigeo.departamentos;
	var distritos     = ubigeo.distritos;
	var provincias    = ubigeo.provincias;

</script>

<script>
	var appConfig = new Vue({
		el: '#config',
		data:{

			//=>DATA PARA MENÚ
			bodyChoice:1,
			showMenu:"",
			menuConfig:[
				{item:"Información", idItem:1},
				{item:"Usuarios Empleados", idItem:2},
				{item:"Cargos de Usuarios", idItem:16},
				{item:"Sucursales - Sedes", idItem:3},
				{item:"Tipos de Inventario", idItem:4},
				{item:"Categorías de Producto", idItem:5},
				{item:"Unidades de Medida", idItem:6},
				{item:"Configuración Avanzada", idItem:15}
			],
			
			//=> DATA PARA CATEGORÍAS
			dataNuevaCategoria:{
				nombre:""
			},

			//=> DATA PARA UNIDADES DE MEDIDA
			dataNuevaUnidad:{
				nombre:"",
				abreviatura:""
			},

			//=> DATA PARA SUCURSAL
			dataSucursal:{
				nombre:"",
				direccion:"",
				lugar:"",
				descripcion:"",
				serie:"",
				id:""
			},

			//=> DATA PARA USUARIO EMPLEADO
			dataUsuarioEmpleado:{
				nombre:"",
				tipo_documento:"",
				nro_documento:"",
				direccion:"",
				email:"",
				password:"",
				cargo_name:"",
				genero:"",
				sucursal_name:""
			},

			genero: [
				{"value":"FEMENINO", "option":"FEMENINO"},
				{"value":"MASCULINO", "option":"MASCULINO"}
			],

			tipo_doc: [
				{"value":"DNI", "option":"DNI"},
				{"value":"CARNET DE EXTRANJERIA", "option":"CARNET DE EXTRANJERIA"}
			],

			//=> DATA PARA CARGO
			dataCargo:{
				nombre:"",
			},

			ubigeo:{
				departamentos:ubigeo.departamentos,
				provincias:[],
				distritos:[]
			},
			lugar:{
				departamento:"",
				provincia:"",
				distrito:""
			},
			activeDir: true,
			empresaEdit:{
				razon_social: "",
				ruc: "",
				nombre_comercial:"",
				direccion:"",
				pais:"",
				distrito:"",
				provincia:"",
				departamento:"",
				descripcion:"",
				vision:"",
				mision:"",
			},
			dataTipoInventario:{
				nombre:""
			},

			cargosReceive: {!!$cargos!!},
			sucursalesReceive: {!!$sucursales!!},
			stateOfTemplateCargos: false,
			stateOfTemplateSucursales: false

			
		},
		created: function(){
			$('#inf').css({'background-color':'#ececec'});
			this.showMenu = "display:block";
			
			this.empresaEdit.razon_social = $('#rs').val();
			this.empresaEdit.ruc = $('#ruc').val();
			this.empresaEdit.nombre_comercial = $('#nc').val();
			this.empresaEdit.pais = $('#pa').val();
			this.empresaEdit.departamento = $('#de').val();
			this.empresaEdit.provincia = $('#pr').val();
			this.empresaEdit.distrito = $('#di').val();
			this.empresaEdit.direccion = $('#dir').val();
			this.empresaEdit.descripcion = $('#des').val();
			this.empresaEdit.vision = $('#vi').val();
			this.empresaEdit.mision = $('#mi').val();


		},
		methods: {

			accept: function(){
				readURL($('#imageUpload'));
			},
			onKey: function(){
				this.empresaEdit.razon_social = $('#rs').val();
				this.empresaEdit.ruc = $('#ruc').val();
				this.empresaEdit.nombre_comercial = $('#nc').val();
				this.empresaEdit.pais = $('#pa').val();
				this.empresaEdit.direccion = $('#dir').val();
				this.empresaEdit.descripcion = $('#des').val();
				this.empresaEdit.vision = $('#vi').val();
				this.empresaEdit.mision = $('#mi').val();
			},
			onChangeDepartamento: function(){
				appConfig.ubigeo.provincias = ubigeo.provincias[appConfig.lugar.departamento];
				for (var i = 0; i < appConfig.ubigeo.departamentos.length; i++) {
					if(appConfig.ubigeo.departamentos[i]['id_ubigeo']==appConfig.lugar.departamento){
						appConfig.empresaEdit.departamento = appConfig.ubigeo.departamentos[i]['nombre_ubigeo']
					}
				}
			},
			onChangeProvincia: function(){
				appConfig.ubigeo.distritos = ubigeo.distritos[appConfig.lugar.provincia];
				for (var i = 0; i < appConfig.ubigeo.provincias.length; i++) {
					if(appConfig.ubigeo.provincias[i]['id_ubigeo']==appConfig.lugar.provincia){
						appConfig.empresaEdit.provincia = appConfig.ubigeo.provincias[i]['nombre_ubigeo']
					}
				}
			},
			onChangeDistrito: function(){
				for (var i = 0; i < appConfig.ubigeo.distritos.length; i++) {
					if(appConfig.ubigeo.distritos[i]['id_ubigeo']==appConfig.lugar.distrito){
						appConfig.empresaEdit.distrito = appConfig.ubigeo.distritos[i]['nombre_ubigeo']
					}
				}
			},
			onClickActivarEditDireccion: function(){
				this.activeDir = false;
			},
			onClickDesactivarEditDireccion: function(){
				this.activeDir = true;
			},
			
			//=> FUNCIONES REUTILIZABLES

			/*===/ Función Reutilizable para pintar Item /===*/
			colorItemClicked: function(id){

				//Recorre cada elemento de clase .myItems
				$('.myItems').each(function(){

					//Evalua si es igual a "id"
					if($(this).attr('data-item')==id){
						//Pinta
						$(this).css({'background-color':'#ececec'});
					}else{
						//Deja en Blanco
						$(this).css({'background-color':'white'});
					}
				});

			},
			
			/*===/ Función Reutilizable para mostrar el Template Clickeado /===*/
			showTemplateClicked: function(id){
				appConfig.bodyChoice = id;
			},

			/*===/ Funciòn Reutilizable para poner datos en DataTable /===*/
			putDataTable: function(elemento, parteSlug, columnas, orden, text, emptyText){

				//llamando a funciòn Datatable
				$(elemento).DataTable({
					"ajax": '{{ url("ajax/obtener") }}/'+parteSlug+'/{{ $empresa->id }}',
					"columns": columnas,
					"order": [[ orden, "desc" ]],
					"pageLength": 10, 
					"language":{
						"loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
						"lengthMenu":"Mostrar _MENU_ "+text,
						"info":"Mostrando _START_ hasta _END_ de _TOTAL_ "+text,
						"paginate": {
							"first":"Primero",
							"last":"Último",
							"next":"Siguiente",
							"previous":"Anterior"
						},
						"search":"Buscar:",
						"emptyTable": "No Hay "+emptyText+".",
					},
					"destroy":true
				});

			},

			//=> FUNCIONES PARA INFORMACIÓN

			/*===/ Función para mostrar template de información /===*/
			showTemplateInformacion: function(id){
				
				//Llama a la función reutilizable para pintar el item
				appConfig.colorItemClicked(id);

				//Llama a la función reutilizable para mostrar el Template
				appConfig.showTemplateClicked(id);

			},

			/*===/ Funciòn que muestra el template para editar informaciòn /===*/
			onClickEditarInformacion: function(){

				//Llama a la función reutilizable para mostrar el Template de editar informaciòn
				appConfig.showTemplateClicked(7);

			},

			/*===/ Funciòn que guarda la informaciòn editada /===*/
			onClickGuardarEditarInformacion: function(){

				//token de empresa
				var token = $('#token_empresa').val();

				//ajax para guardar la informaciòn editada
				$.ajax({
					headers: {'X-CSRF-Token':token},
					url: '{{ url('ajax/edit/save/empresa') }}/{{ $empresa->id }}',
					data: {empresa:appConfig.empresaEdit},
					type: 'POST',
					dataType: 'JSON',
					success: function(data){
						if(data==1){
							location.href = "/administracion";
						}
					}
				});

			},

			//=> FUNCIONES PARA USUARIOS

			showTemplateUsuarios: function(id){
				
				//Llama a la función reutilizable para pintar el item
				appConfig.colorItemClicked(id);

				//Llama a la función reutilizable para mostrar el Template
				appConfig.showTemplateClicked(id);

				//Valores para función putDataTable
				var elemento = "#table-users-employed";
				var parteSlug = "usuarios-empleados";
				var columnas = [
					{ "data": "numero" },
                    { "data": "usuario_empleado" },
                    { "data": "documento" },
                    { "data": "email" },
                    { "data": "cargo" },
					{ "data": "sucursal" },
                    { "data": "created_at" },
                    { "data": "opciones" }
				];
				var orden = 6;
				var text = "Usuarios Empleados";
				var emptyText = "Usuarios Empleados Registrados"; 
				
				//Llama a la función reutilizable para Datatable
				appConfig.putDataTable(elemento, parteSlug, columnas, orden, text, emptyText);

				// $.ajax({
				// 	url:'{{ url("ajax/obtener") }}/usuarios-empleados/{{ $empresa->id }}',
				// 	type:'get',
				// 	dataType: 'json',
				// 	success: function(data){
				// 		console.log(data);
				// 	}
				// })

			},

			onClickNuevoUsuario: function(){

				appConfig.dataUsuarioEmpleado.nombre="";
				appConfig.dataUsuarioEmpleado.tipo_documento="";
				appConfig.dataUsuarioEmpleado.nro_documento="";
				appConfig.dataUsuarioEmpleado.direccion="";
				appConfig.dataUsuarioEmpleado.email="";
				appConfig.dataUsuarioEmpleado.password="";
				appConfig.dataUsuarioEmpleado.cargo_name="";
				appConfig.dataUsuarioEmpleado.genero="";
				appConfig.dataUsuarioEmpleado.sucursal_name="";

				if(appConfig.cargosReceive.length>0&&appConfig.sucursalesReceive.length>0){
					appConfig.stateOfTemplateCargos = false;
					appConfig.stateOfTemplateSucursales = false;
					appConfig.showTemplateClicked(14);
				}else{
					if(appConfig.cargosReceive.length==0&&appConfig.sucursalesReceive.length>0){
						appConfig.stateOfTemplateCargos = true;
						appConfig.stateOfTemplateSucursales = false;
						appConfig.showTemplateClicked(14);
					}

					else if(appConfig.sucursalesReceive.length==0&&appConfig.cargosReceive.length>0){
						appConfig.stateOfTemplateCargos = false;
						appConfig.stateOfTemplateSucursales = true;
						appConfig.showTemplateClicked(14);
					}else if (appConfig.sucursalesReceive.length==0&&appConfig.cargosReceive.length==0){
						appConfig.stateOfTemplateCargos = true;
						appConfig.stateOfTemplateSucursales = true;
						appConfig.showTemplateClicked(14);
					}
					
					
				}
				

			},

			/*===/ Funciòn que guarda el nuevo usuario /===*/
			onClickGuardarNuevoUsuario: function(){
				

				if(this.dataUsuarioEmpleado.nombre!=""&&this.dataUsuarioEmpleado.nro_documento!=""&&this.dataUsuarioEmpleado.direccion!=""&&this.dataUsuarioEmpleado.genero!=""&&this.dataUsuarioEmpleado.email!=""&&this.dataUsuarioEmpleado.password!=""){

					var token = $('#token_employed').val();

					$.ajax({
						headers: {'X-CSRF-Token':token},
						url: '/ajax/save/user/employed',
						data: {
							user: appConfig.dataUsuarioEmpleado
						},
						type: 'POST',
						dataType: 'JSON',
						success: function(data){
							if(data==1){
								appConfig.showTemplateUsuarios(2);
							}
						}
					});

				}else{
					console.log('puff');
				}
			},

			onClickEditarUsuarioEmpleado: function(id){
				appConfig.bodyChoice = 18;

				

				$.ajax({
					url: "{{ url('/ajax/obtener/usuario/empleado') }}/"+id,
					type: 'get',
					dataType: 'json',
					success: function(data){
						
						appConfig.dataUsuarioEmpleado.nombre=data.user_name;
						appConfig.dataUsuarioEmpleado.tipo_documento=data.tipo_documento;
						appConfig.dataUsuarioEmpleado.nro_documento=data.doc_identidad;
						appConfig.dataUsuarioEmpleado.direccion=data.direccion;
						appConfig.dataUsuarioEmpleado.email=data.user_email;
						appConfig.dataUsuarioEmpleado.password=data.password;
						appConfig.dataUsuarioEmpleado.cargo_name=data.cargo;
						appConfig.dataUsuarioEmpleado.genero=data.genero;
						appConfig.dataUsuarioEmpleado.sucursal_name=data.sucursal;
					}
				})
			},

			//  => FUNCIONES PARA SUCURSALES

			/*===/ Función que muestra Template Sucursales y las lista/===*/
			showTemplateSucursales: function(id){

				appConfig.dataSucursal.nombre = "";
				appConfig.dataSucursal.descripcion = "";
				appConfig.dataSucursal.direccion = "";
				appConfig.dataSucursal.lugar = "";
				appConfig.dataSucursal.serie = "";
				
				//Llama a la función reutilizable para pintar el item
				appConfig.colorItemClicked(id);

				//Llama a la función reutilizable para mostrar el Template
				appConfig.showTemplateClicked(id);

				//Valores para función putDataTable
				var elemento = "#table-sucursales";
				var parteSlug = "sucursales";
				var columnas = [
					{ "data": "numero" },
                    { "data": "nombre_sucursal" },
                    { "data": "direccion" },
                    { "data": "lugar" },
                    { "data": "created_at" },
                    { "data": "opciones" }
				];
				var orden = 4;
				var text = "Sucursales";
				var emptyText = "Sucursales Registradas"; 
				
				//Llama a la función reutilizable para Datatable
				appConfig.putDataTable(elemento, parteSlug, columnas, orden, text, emptyText);
			
			},

			/*===/ Funciòn que muestra el template para nueva sucursal /===*/
			onClickNuevaSucursal: function(){

				//Llama a la función reutilizable para mostrar el Template de nueva sucursal
				appConfig.showTemplateClicked(9);

			},

			/*===/ Funciòn que guarda la nueva sucursal /===*/
			onClickGuardarSucursal: function(){
				

				//token sucursal
				var token = $('#token-suc').val();

				if(appConfig.dataSucursal.nombre!=""&&appConfig.dataSucursal.lugar!=""&&appConfig.dataSucursal.direccion!=""){
					//convirtiendo a mayusculas
					appConfig.dataSucursal.nombre = appConfig.dataSucursal.nombre.toUpperCase();
					appConfig.dataSucursal.descripcion = appConfig.dataSucursal.descripcion.toUpperCase();
					appConfig.dataSucursal.direccion = appConfig.dataSucursal.direccion.toUpperCase();
					appConfig.dataSucursal.lugar = appConfig.dataSucursal.lugar.toUpperCase();
					appConfig.dataSucursal.serie = appConfig.dataSucursal.serie.toUpperCase();

					//ajax guarda la nueva sucursal
					$.ajax({
	                    headers: {'X-CSRF-Token':token},
	                    url: "{{ url('/ajax/guardar/sucursal/empresa') }}/{{ $empresa->id }}",
	                    data: this.dataSucursal,
	                    type: 'post',
	                    dataType: 'json',                        
	                    success: function(data){	
	                        if(data==1){     
	                          	appConfig.onClickItem(3);  
	                          	appConfig.dataSucursal.nombre = "";
								appConfig.dataSucursal.descripcion = "";
								appConfig.dataSucursal.direccion = "";
								appConfig.dataSucursal.lugar = "";
								appConfig.dataSucursal.serie = ""; 
								appConfig.getSucursales();
	                        }    
	                    }
	                });

				}else{
					$('.mensaje-validate').append('<div class="row"><div class="col-md-12"><div class="alert alert-warning alert-dismissible" style="border-radius: 3px"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="right: 0px">×</button>Los Campos con asterisco son obligatorios.</div></div></div>')
				}
			},

			onClickEditarSucursal: function(id){
				appConfig.bodyChoice = 13;
				console.log(id);
				$.ajax({
					url: '{{ url('ajax/get/sucursal') }}/'+id,
					type: 'get',
					dataType: 'json',
					success: function(data){
						appConfig.dataSucursal.nombre = data.nombre_sucursal;
						appConfig.dataSucursal.descripcion = data.descripcion;
						appConfig.dataSucursal.direccion = data.direccion;
						appConfig.dataSucursal.lugar = data.lugar;
						appConfig.dataSucursal.serie = data.serie;
						appConfig.dataSucursal.id = data.id;
					}
				})
			},

			onClickGuardarEditarSucursal: function(){
				//token sucursal
				var token = $('#token-suc-editar').val();

				if(appConfig.dataSucursal.nombre!=""&&appConfig.dataSucursal.lugar!=""&&appConfig.dataSucursal.direccion!=""){
					//convirtiendo a mayusculas
					appConfig.dataSucursal.nombre = appConfig.dataSucursal.nombre.toUpperCase();
					
					appConfig.dataSucursal.direccion = appConfig.dataSucursal.direccion.toUpperCase();
					appConfig.dataSucursal.lugar = appConfig.dataSucursal.lugar.toUpperCase();
					

					if(appConfig.dataSucursal.serie==null||appConfig.dataSucursal.descripcion==null){
						//nada
					}else{	
						appConfig.dataSucursal.serie = appConfig.dataSucursal.serie.toUpperCase();
						appConfig.dataSucursal.descripcion = appConfig.dataSucursal.descripcion.toUpperCase();
					}	

					//ajax guarda la nueva sucursal
					$.ajax({
	                    headers: {'X-CSRF-Token':token},
	                    url: "{{ url('/ajax/guardar/editar/sucursal') }}/"+appConfig.dataSucursal.id+"/empresa/{{ $empresa->id }}",
	                    data: this.dataSucursal,
	                    type: 'post',
	                    dataType: 'json',                        
	                    success: function(data){	
	                        if(data==1){     
	                          	appConfig.onClickItem(3);  
	                          	appConfig.dataSucursal.nombre = "";
								appConfig.dataSucursal.descripcion = "";
								appConfig.dataSucursal.direccion = "";
								appConfig.dataSucursal.lugar = "";
								appConfig.dataSucursal.serie = ""; 
	                        }    
	                    }
	                });

				}else{
					$('.mensaje-validate').append('<div class="row"><div class="col-md-12"><div class="alert alert-warning alert-dismissible" style="border-radius: 3px"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="right: 0px">×</button>Los Campos con asterisco son obligatorios.</div></div></div>')
				}
			},

			getSucursales: function(){
				$.ajax({
					url: "{{ url('/ajax/obtener/sucursales/2/') }}/{{ $empresa->id }}",
					type: 'GET',
					dataType: 'JSON',
					success: function(data){
						appConfig.sucursalesReceive = data;
						console.log(data);
					}
				});
			},

			//=> FUNCIONES PARA TIPOS DE INVENTARIO

			/*===/ Función que muestra Template Tipos de Inventario y los lista /===*/
			showTemplateTiposInventario: function(id){
				
				//Llama a la función reutilizable para pintar el item
				appConfig.colorItemClicked(id);

				//Llama a la función reutilizable para mostrar el Template
				appConfig.showTemplateClicked(id);

				//Valores para función putDataTable
				var elemento = "#table-tinventarios";
				var parteSlug = "tipos-inventario";
				var columnas = [
					{ "data": "numero" },
					{ "data": "tipo_inventario" },
					{ "data": "created_at" },
					{ "data": "opciones" }
				];
				var orden = 2;
				var text = "Tipos de Inventario";
				var emptyText = "Tipos de Inventario Registrados"; 
				
				//Llama a la función reutilizable para Datatable
				appConfig.putDataTable(elemento, parteSlug, columnas, orden, text, emptyText);

			},

			/*===/ Funciòn que muestra el template para nuevo tipo de inventario /===*/
			onClickNuevoTipoInventario: function(){
				$('#guardar-nuevo-tipo-inventario').removeAttr('disabled');
				$('#message-tipo-vacio').hide();
				//limpiamos model nombre tipo de inventario
				this.dataTipoInventario.nombre = "";
				//Llama a la función reutilizable para mostrar el Template de nueva tipo de inventario
				appConfig.showTemplateClicked(10);
				
			},

			/*===/ Funciòn que guarda el nuevo tipo de inventario /===*/
			onClickGuardarTipoInventario: function(){
				//token tipo inventario
				var token = $('#token_tinv').val();

				//evalua si el nombre de inventario esta vacio
				if(this.dataTipoInventario.nombre!=""){

					$('#guardar-nuevo-tipo-inventario').attr('disabled','disabled');
					//ajax para guardar el tipo de inventario nuevo
					$.ajax({
                        headers: {'X-CSRF-Token':token},
                        url: "{{ url('/ajax/guardar/tipo-inventario') }}/{{ $empresa->id }}",
                        data: {nombre:this.dataTipoInventario.nombre.toUpperCase()},
                        type: 'post',
                        dataType: 'json',
                        
                        success: function(data){
                        	
                            if(data==1){
                                
                            	appConfig.onClickItem(4);

                                
                            }
                            
                        }
                    })
				}else{
					$('#guardar-nuevo-tipo-inventario').removeAttr('disabled');
					$('.msg-by-empty-input').show();
					$('.msg-by-empty-input').html("Se debe Ingresar un <b>Nombre de Tipo de Inventario</b>.")
					$('.msg-by-empty-input').addClass('message-vacio')

					setTimeout(function(){
						$('.msg-by-empty-input').hide();
					}, 4000);
				}


				
			},

			//=> FUNCIONES PARA CATEGORÍAS DE PRODUCTO

			/*===/ Función que muestra Template Categorías y los lista /===*/
			showTemplateCategorias: function(id){
				
				//Llama a la función reutilizable para pintar el item
				appConfig.colorItemClicked(id);

				//Llama a la función reutilizable para mostrar el Template
				appConfig.showTemplateClicked(id);

				//Valores para función putDataTable
				var elemento = "#table-categorias";
				var parteSlug = "categorias";
				var columnas = [
					{ "data": "numero" },
                    { "data": "categoria" },
                    { "data": "created_at" },
                    { "data": "opciones" }
				];
				var orden = 2;
				var text = "Categorías";
				var emptyText = "Categorías Registradas"; 
				
				//Llama a la función reutilizable para Datatable
				appConfig.putDataTable(elemento, parteSlug, columnas, orden, text, emptyText);

			},

			/*===/ Funciòn que muestra el template para nueva categorìa /===*/
			onClickNuevaCategoria: function(){
				this.dataNuevaCategoria.nombre = "";
				$('#guardar-nueva-categoria').removeAttr('disabled');
				//Llama a la función reutilizable para mostrar el Template de nueva categoria
				appConfig.showTemplateClicked(11);

			},

			/*===/ Funciòn que guarda la nueva categoria /===*/
			onClickGuardarCategoria: function(){

				var token = $('#token_categoria').val();

				if(this.dataNuevaCategoria.nombre != ""){

					$('#guardar-nueva-categoria').attr('disabled','disabled');

					$.ajax({
                        headers: {'X-CSRF-Token':token},
                        url: "{{ url('/ajax/config/guardar/categoria') }}/{{ $empresa->id }}",
                        data: {nombre:this.dataNuevaCategoria.nombre.toUpperCase()},
                        type: 'post',
                        dataType: 'json',
                        
                        success: function(data){
                        	
                            if(data==1){
                                
                            	appConfig.onClickItem(5);
                            	appConfig.dataNuevaCategoria.nombre = "";
                            }
                            
                        }
                    });

				}else{

					$('#guardar-nueva-categoria').removeAttr('disabled');
					$('.msg-by-empty-input').show();
					$('.msg-by-empty-input').html("Se debe Ingresar un <b>Nombre de Categoria</b>.")
					$('.msg-by-empty-input').addClass('message-vacio')

					setTimeout(function(){
						$('.msg-by-empty-input').hide();
					}, 4000);

				}
				
					
			},

			//=> FUNCIONES PARA UNIDADES DE MEDIDA

			/*===/ Función para mostrar template de listado de Unidades de Medida/===*/
			showTemplateUnidades: function(id){
				
				//Llama a la función reutilizable para pintar el item
				appConfig.colorItemClicked(id);

				//Llama a la función reutilizable para mostrar el Template
				appConfig.showTemplateClicked(id);

				//Valores para función putDataTable
				var elemento = "#table-unidades";
				var parteSlug = "unidades";
				var columnas = [
					{ "data": "numero" },
                    { "data": "unidad" },
                    { "data": "abreviatura" },
                    { "data": "created_at" },
                    { "data": "opciones" }
				];
				var orden = 3;
				var text = "Unidades de Medida";
				var emptyText = "Unidades de Medida Registradas"; 
				
				//Llama a la función reutilizable para Datatable
				appConfig.putDataTable(elemento, parteSlug, columnas, orden, text, emptyText);

			},

			/*===/ Funciòn que muestra el template para unidad de medida /===*/
			onClickNuevaUnidad: function(){
				$('#guardar-nueva-unidad').removeAttr('disabled');
				this.dataNuevaUnidad.nombre = "";
				this.dataNuevaUnidad.abreviatura = "";
				//Llama a la función reutilizable para mostrar el Template de nueva unidad de medida
				appConfig.showTemplateClicked(12);

			},

			onClickGuardarUnidad: function(){

				var token = $('#token_unidad').val();

				if(this.dataNuevaUnidad.nombre!=""&&this.dataNuevaUnidad.abreviatura!=""){
					$('#guardar-nueva-unidad').attr('disabled','disabled');

					$.ajax({
                        headers: {'X-CSRF-Token':token},
                        url: "{{ url('/ajax/config/guardar/unidad') }}/{{ $empresa->id }}",
                        data: {nombre:this.dataNuevaUnidad.nombre.toUpperCase(), abreviatura:this.dataNuevaUnidad.abreviatura.toUpperCase()},
                        type: 'post',
                        dataType: 'json',
                        
                        success: function(data){
                        	
                            if(data==1){
                                
                            	appConfig.onClickItem(6);
                            	appConfig.dataNuevaUnidad.nombre="";
                            	appConfig.dataNuevaUnidad.abreviatura="";
                                
                            }
                            
                        }
                    });
				}else{
					$('#guardar-nueva-unidad').removeAttr('disabled');
					$('.msg-by-empty-input').show();
					$('.msg-by-empty-input').html("Se debe Ingresar un <b>Nombre de Unidad de Medidad</b> con su <b>Abreviatura</b> respectiva.")
					$('.msg-by-empty-input').addClass('message-vacio')

					setTimeout(function(){
						$('.msg-by-empty-input').hide();
					}, 4000);
				}	
				
					

			},

			//=> FUNCIONES PARA CONFIGURACION AVANZADA

			/*===/ Función para mostrar template de Configuración Avanzada /===*/
			showTemplateConfiguracionAvanzada: function(id){
				console.log(id);
				
				//Llama a la función reutilizable para pintar el item
				// appConfig.colorItemClicked(id);

				//Llama a la función reutilizable para mostrar el Template
				appConfig.showTemplateClicked(id);

			},

			//=> FUNCIONES PARA ROLES DE USUARIO

			/*===/ Función para mostrar template de Configuración Avanzada /===*/
			showTemplateCargos: function(id){
				
				//Llama a la función reutilizable para pintar el item
				// appConfig.colorItemClicked(id);

				//Llama a la función reutilizable para mostrar el Template
				appConfig.showTemplateClicked(id);

				//Valores para función putDataTable
				var elemento = "#table-cargos";
				var parteSlug = "cargos";
				var columnas = [
					{ "data": "numero" },
                    { "data": "cargo" },
                    { "data": "created_at" },
                    { "data": "opciones" }
				];
				var orden = 2;
				var text = "Cargos de Usuarios Empleados";
				var emptyText = "Cargos de Usuarios Empleados Registrados"; 
				
				//Llama a la función reutilizable para Datatable
				appConfig.putDataTable(elemento, parteSlug, columnas, orden, text, emptyText);

			},

			/*===/ Funciòn que muestra el template para nuevo rol /===*/
			onClickNuevoCargo: function(){

				appConfig.showTemplateClicked(17);
			},

			onClickGuardarCargo: function(){
				console.log('hola');
				//token sucursal
				var token = $('#token-cargo').val();

				if(appConfig.dataCargo.nombre!=""){
					//convirtiendo a mayusculas
					appConfig.dataCargo.nombre = appConfig.dataCargo.nombre.toUpperCase();

					//ajax guarda la nueva sucursal
					$.ajax({
	                    headers: {'X-CSRF-Token':token},
	                    url: "{{ url('/ajax/guardar/cargo/empresa') }}/{{ $empresa->id }}",
	                    data: this.dataCargo,
	                    type: 'post',
	                    dataType: 'json',                        
	                    success: function(data){	
	                        if(data==1){     
	                          	appConfig.onClickItem(16);  
	                          	appConfig.dataCargo.nombre = "";
	                          	appConfig.getCargos();
	                        }    
	                    }
	                });

				}else{
					$('.mensaje-validate').append('<div class="row"><div class="col-md-12"><div class="alert alert-warning alert-dismissible" style="border-radius: 3px"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="right: 0px">×</button>Los Campos con asterisco son obligatorios.</div></div></div>')
				}
			},

			getCargos: function(){
				$.ajax({
					url: '{{ url('ajax/obtener/cargos/empresa') }}/{{ $empresa->id }}',
					type: 'GET',
					dataType: 'JSON',
					success: function(data){
						appConfig.cargosReceive = data;
					}
				});
			},

			//==> FUNCIONES DEL MENU

			/*===/ Función que se activa al clickear un item del menú /===*/
			onClickItem: function(idItem){

				//Case de cada item
				switch (idItem) {

					//Case 1: para Información
					case 1:
						appConfig.showTemplateInformacion(idItem);
						break;

					//Case 2: para Usuarios
					case 2:
						appConfig.showTemplateUsuarios(idItem);
						break;

					//Case 3: para Sucursales
					case 3:
						appConfig.showTemplateSucursales(idItem);
						break;

					//Case 4: para Tipos de Inventario
					case 4:
						appConfig.showTemplateTiposInventario(idItem);
						break;

					//Case 5: para Unidades de Medida
					case 5:
						appConfig.showTemplateCategorias(idItem);
						break;

					//Case 6: para Unidades de Medida
					case 6:
						appConfig.showTemplateUnidades(idItem);
						break;

					//Case 15: para Configuración Avanzada
					case 15:
						appConfig.showTemplateConfiguracionAvanzada(idItem);
						break;

					//Case 16: para Roles de Usuario
					case 16:
						appConfig.showTemplateCargos(idItem);
						break;
				
					default:
						break;
				}

			}

		}
	});
</script>
@endsection