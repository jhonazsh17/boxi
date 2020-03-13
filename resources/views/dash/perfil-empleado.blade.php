@extends('base-other')

@section('contenedor')
<div id="app-perfil">

	<br>

	<div class="container">
		<div class="row">
			<div class="col-md-3" style="padding-right: 7px">
				<div class="panel-customize">
					<!-- <div class="panel-self-head text-center">
						
					</div> -->
					<div class="panel-boxi panel-b-pre-fixed">
						<div class="panel-boxi_head text-center">
							
		                        <b>{{ Auth::user()->name }} </b>
		                    
						</div>
						<div class="text-center" style="background-color: #eaecea; height: 120px; position: relative; z-index: 1">
								<img src="{{ url('img/perfil.jpg') }}" alt="..." class="img-circle" width="50%" style="position: relative; top: 45px; z-index: 2; border: 5px solid white">
						</div>
						<div class="panel-boxi_body">
							
							<div class="text-center">
								<br>
								<br>
								<button class="btn btn-default btn-xs margin-1-top">Cambiar Imágen</button>
								<div class="margin-1-top">
									
				                        <small>{{ Auth::user()->email }}</small>
				                        <br>
				                        {{$empleado->cargo->nombre}}<br>
				                        <b>{{$empresa->nombre_comercial}}</b>
								</div>
							</div>
							
							
						</div>
						<div class="border-first_top put-padding-1">
							<b>Mi Bio:</b>
							<p class="text-justify supr-margin">
								<small>Soy una persona que le gusta mucho cantar :D y me gusta One piece anime.</small>
							</p>
						</div>
						<div class="menu-perfil border-first_top put-padding-1" v-on:click="onClickMuro()">
							Mi Muro
						</div>
						<div class="menu-perfil border-first_top put-padding-1" v-on:click="onClickMensajes()">
							Mensajes
						</div>
						<div class="menu-perfil border-first_top put-padding-1" v-on:click="onClickAjustes()">
							Ajustes del Perfil
						</div>
							
						
						
					</div>
					
				</div>
			</div>
			<div v-show="templateMenu=='muro'" class="col-md-9" style="padding-left: 7px">
				<div class="panel-customize">
					<div class="panel-self-head">
						<div class="panel-boxi">
							<div class="panel-boxi_head">
								<b style="font-size: 1.2em">Mi Muro</b>
							</div>
							<div class="panel-boxi_body">
								
								<div class="panel-boxi-2 margin-1-bottom">
									<div class="panel-boxi-2_head">
										<b>Corregir Factura 001-2500</b>
									</div>
									<div class="panel-boxi-2_body">
										Por favor, corregir la factura 001-2500, el monto no concuerda lo que se ha facturado.
									</div>
									<div class="panel-boxi-2_footer">
										<button class="btn btn-like btn-xs">
											<i class="fa fa-thumbs-up"></i>
										</button>
										<button class="btn btn-like btn-xs">
											<i class="fa fa-comments"></i>
										</button>
									</div>
									
								</div>

								<div class="panel-boxi-2 margin-1-bottom">
									<div class="panel-boxi-2_head">
										<b>Corregir Factura 001-2500</b>
									</div>
									<div class="panel-boxi-2_body">
										Por favor, corregir la factura 001-2500, el monto no concuerda lo que se ha facturado.
									</div>
									<div class="panel-boxi-2_footer">
										<button class="btn btn-like btn-xs">
											<i class="fa fa-thumbs-up"></i>
										</button>
										<button class="btn btn-like btn-xs">
											<i class="fa fa-comments"></i>
										</button>
									</div>
									
								</div>

								<div class="panel-boxi-2 margin-1-bottom">
									<div class="panel-boxi-2_head">
										<b>Corregir Factura 001-2500</b>
									</div>
									<div class="panel-boxi-2_body">
										Por favor, corregir la factura 001-2500, el monto no concuerda lo que se ha facturado.
									</div>
									<div class="panel-boxi-2_footer">
										<button class="btn btn-like btn-xs">
											<i class="fa fa-thumbs-up"></i>
										</button>
										<button class="btn btn-like btn-xs">
											<i class="fa fa-comments"></i>
										</button>
									</div>
									
								</div>

								<div class="panel-boxi-2 margin-1-bottom">
									<div class="panel-boxi-2_head">
										<b>Corregir Factura 001-2500</b>
									</div>
									<div class="panel-boxi-2_body">
										Por favor, corregir la factura 001-2500, el monto no concuerda lo que se ha facturado.
									</div>
									<div class="panel-boxi-2_footer">
										<button class="btn btn-like btn-xs">
											<i class="fa fa-thumbs-up"></i>
										</button>
										<button class="btn btn-like btn-xs">
											<i class="fa fa-comments"></i>
										</button>
									</div>
									
								</div>

								<div class="panel-boxi-2 margin-1-bottom">
									<div class="panel-boxi-2_head">
										<b>Corregir Factura 001-2500</b>
									</div>
									<div class="panel-boxi-2_body">
										Por favor, corregir la factura 001-2500, el monto no concuerda lo que se ha facturado.
									</div>
									<div class="panel-boxi-2_footer">
										<button class="btn btn-like btn-xs">
											<i class="fa fa-thumbs-up"></i>
										</button>
										<button class="btn btn-like btn-xs">
											<i class="fa fa-comments"></i>
										</button>
									</div>
									
								</div>

								<div class="panel-boxi-2 margin-1-bottom">
									<div class="panel-boxi-2_head">
										<b>Corregir Factura 001-2500</b>
									</div>
									<div class="panel-boxi-2_body">
										Por favor, corregir la factura 001-2500, el monto no concuerda lo que se ha facturado.
									</div>
									<div class="panel-boxi-2_footer">
										<button class="btn btn-like btn-xs">
											<i class="fa fa-thumbs-up"></i>
										</button>
										<button class="btn btn-like btn-xs">
											<i class="fa fa-comments"></i>
										</button>
									</div>
									
								</div>
								
							</div>
							
							
						</div>
					</div>
				</div>
			</div>
			<div v-show="templateMenu=='mensajes'" class="col-md-9" style="padding-left: 7px">
				<div class="panel-boxi">
					<div class="panel-boxi_head">
						<b style="font-size: 1.2em">Mensajes (14)</b>
					</div>
					<div class="panel-boxi_body">
						<div class="row">
							<div class="col-md-10 put-padding-1-bottom" style="padding-right: 7px">
								<div class="form-group supr-margin">
									<input type="text" class="form-control input-sm" placeholder="Buscar Mensajes">
								</div>
							</div>
							<div class="col-md-2 put-padding-1-bottom" style="padding-left: 7px">
								<button class="btn btn-default btn-sm btn-block"><i class="fa fa-plus"></i>Nuevo Mensaje</button>
							</div>
							
						</div>
						<div class="mensajes-contenedor" >
							<div class="list-group supr-margin">
							  <a href="#" class="list-group-item">
							  	<div class="row">
							  		<div class="col-md-1" style="padding-right: 7px">
							  			<img class="media-object" src="{{ url('img/perfil.jpg') }}" alt="..." width="48px" style="border: 3px solid #ccc; border-radius: 3px">
							  		</div>
							  		<div class="col-md-11" style="padding-left: 7px">
							  			<h5 style="font-size: 1.1em; font-weight: bold" class="supr-margin">
							  				Urgente Contestar sobre envio
							  			</h5>
							  			<p class="put-padding-1-top supr-margin">
							  				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ab quaerat ullam eaque exercitationem laboriosam aliquid dicta accusantium ....
							  			</p>
							  		</div>
							  	</div>
							  </a>
							  <a href="#" class="list-group-item">
							  	<div class="row">
							  		<div class="col-md-1" style="padding-right: 7px">
							  			<img class="media-object" src="{{ url('img/perfil2.jpg') }}" alt="..." width="48px" style="border: 3px solid #ccc; border-radius: 3px">
							  		</div>
							  		<div class="col-md-11" style="padding-left: 7px">
							  			<h5 style="font-size: 1.1em; font-weight: bold" class="supr-margin">
							  				Urgente Contestar sobre envio
							  			</h5>
							  			<p class="put-padding-1-top supr-margin">
							  				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ab quaerat ullam eaque exercitationem laboriosam aliquid dicta accusantium ....
							  			</p>
							  		</div>
							  	</div>
							  </a>
							  <a href="#" class="list-group-item">
							  	<div class="row">
							  		<div class="col-md-1" style="padding-right: 7px">
							  			<img class="media-object" src="{{ url('img/perfil2.jpg') }}" alt="..." width="48px" style="border: 3px solid #ccc; border-radius: 3px">
							  		</div>
							  		<div class="col-md-11" style="padding-left: 7px">
							  			<h5 style="font-size: 1.1em; font-weight: bold" class="supr-margin">
							  				Urgente Contestar sobre envio
							  			</h5>
							  			<p class="put-padding-1-top supr-margin">
							  				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ab quaerat ullam eaque exercitationem laboriosam aliquid dicta accusantium ....
							  			</p>
							  		</div>
							  	</div>
							  </a>
							  <a href="#" class="list-group-item">
							  	<div class="row">
							  		<div class="col-md-1" style="padding-right: 7px">
							  			<img class="media-object" src="{{ url('img/perfil1.jpg') }}" alt="..." width="48px" style="border: 3px solid #ccc; border-radius: 3px">
							  		</div>
							  		<div class="col-md-11" style="padding-left: 7px">
							  			<h5 style="font-size: 1.1em; font-weight: bold" class="supr-margin">
							  				Urgente Contestar sobre envio
							  			</h5>
							  			<p class="put-padding-1-top supr-margin">
							  				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ab quaerat ullam eaque exercitationem laboriosam aliquid dicta accusantium ....
							  			</p>
							  		</div>
							  	</div>
							  </a>
							  <a href="#" class="list-group-item">
							  	<div class="row">
							  		<div class="col-md-1" style="padding-right: 7px">
							  			<img class="media-object" src="{{ url('img/perfil.jpg') }}" alt="..." width="48px" style="border: 3px solid #ccc; border-radius: 3px">
							  		</div>
							  		<div class="col-md-11" style="padding-left: 7px">
							  			<h5 style="font-size: 1.1em; font-weight: bold" class="supr-margin">
							  				Urgente Contestar sobre envio
							  			</h5>
							  			<p class="put-padding-1-top supr-margin">
							  				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ab quaerat ullam eaque exercitationem laboriosam aliquid dicta accusantium ....
							  			</p>
							  		</div>
							  	</div>
							  </a>
							  <a href="#" class="list-group-item">
							  	<div class="row">
							  		<div class="col-md-1" style="padding-right: 7px">
							  			<img class="media-object" src="{{ url('img/perfil2	.jpg') }}" alt="..." width="48px" style="border: 3px solid #ccc; border-radius: 3px">
							  		</div>
							  		<div class="col-md-11" style="padding-left: 7px">
							  			<h5 style="font-size: 1.1em; font-weight: bold" class="supr-margin">
							  				Urgente Contestar sobre envio
							  			</h5>
							  			<p class="put-padding-1-top supr-margin">
							  				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ab quaerat ullam eaque exercitationem laboriosam aliquid dicta accusantium ....
							  			</p>
							  		</div>
							  	</div>
							  </a>
							  <a href="#" class="list-group-item">
							  	<div class="row">
							  		<div class="col-md-1" style="padding-right: 7px">
							  			<img class="media-object" src="{{ url('img/perfil.jpg') }}" alt="..." width="48px" style="border: 3px solid #ccc; border-radius: 3px">
							  		</div>
							  		<div class="col-md-11" style="padding-left: 7px">
							  			<h5 style="font-size: 1.1em; font-weight: bold" class="supr-margin">
							  				Urgente Contestar sobre envio
							  			</h5>
							  			<p class="put-padding-1-top supr-margin">
							  				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ab quaerat ullam eaque exercitationem laboriosam aliquid dicta accusantium ....
							  			</p>
							  		</div>
							  	</div>
							  </a>
							  <a href="#" class="list-group-item">
							  	<div class="row">
							  		<div class="col-md-1" style="padding-right: 7px">
							  			<img class="media-object" src="{{ url('img/perfil.jpg') }}" alt="..." width="48px" style="border: 3px solid #ccc; border-radius: 3px">
							  		</div>
							  		<div class="col-md-11" style="padding-left: 7px">
							  			<h5 style="font-size: 1.1em; font-weight: bold" class="supr-margin">
							  				Urgente Contestar sobre envio
							  			</h5>
							  			<p class="put-padding-1-top supr-margin">
							  				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ab quaerat ullam eaque exercitationem laboriosam aliquid dicta accusantium ....
							  			</p>
							  		</div>
							  	</div>
							  </a>
							  <a href="#" class="list-group-item">
							  	<div class="row">
							  		<div class="col-md-1" style="padding-right: 7px">
							  			<img class="media-object" src="{{ url('img/perfil.jpg') }}" alt="..." width="48px" style="border: 3px solid #ccc; border-radius: 3px">
							  		</div>
							  		<div class="col-md-11" style="padding-left: 7px">
							  			<h5 style="font-size: 1.1em; font-weight: bold" class="supr-margin">
							  				Urgente Contestar sobre envio
							  			</h5>
							  			<p class="put-padding-1-top supr-margin">
							  				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ab quaerat ullam eaque exercitationem laboriosam aliquid dicta accusantium ....
							  			</p>
							  		</div>
							  	</div>
							  </a>
							  <a href="#" class="list-group-item">
							  	<div class="row">
							  		<div class="col-md-1" style="padding-right: 7px">
							  			<img class="media-object" src="{{ url('img/perfil.jpg') }}" alt="..." width="48px" style="border: 3px solid #ccc; border-radius: 3px">
							  		</div>
							  		<div class="col-md-11" style="padding-left: 7px">
							  			<h5 style="font-size: 1.1em; font-weight: bold" class="supr-margin">
							  				Urgente Contestar sobre envio
							  			</h5>
							  			<p class="put-padding-1-top supr-margin">
							  				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ab quaerat ullam eaque exercitationem laboriosam aliquid dicta accusantium ....
							  			</p>
							  		</div>
							  	</div>
							  </a>
							  <a href="#" class="list-group-item">
							  	<div class="row">
							  		<div class="col-md-1" style="padding-right: 7px">
							  			<img class="media-object" src="{{ url('img/perfil.jpg') }}" alt="..." width="48px" style="border: 3px solid #ccc; border-radius: 3px">
							  		</div>
							  		<div class="col-md-11" style="padding-left: 7px">
							  			<h5 style="font-size: 1.1em; font-weight: bold" class="supr-margin">
							  				Urgente Contestar sobre envio
							  			</h5>
							  			<p class="put-padding-1-top supr-margin">
							  				Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem ab quaerat ullam eaque exercitationem laboriosam aliquid dicta accusantium ....
							  			</p>
							  		</div>
							  	</div>
							  </a>
							</div> 
							
						</div>
					</div>
				</div>
			</div>
			<div v-show="templateMenu=='ajustes'" class="col-md-9" style="padding-left: 7px">
				<div class="panel-boxi">
					<div class="panel-boxi_head">
						<b style="font-size: 1.2em">Ajustes del Perfil</b>
					</div>
					<div class="panel-boxi_body">
					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	
	
@endsection

@section('scripts')
	<script>
		$(document).scroll(function(){
			var topi = $('.navbar-default').height();
			console.log(topi+" - "+$(this).scrollTop())
			if(topi<$(this).scrollTop()){
				$('.panel-b-pre-fixed').addClass('panel-b-fixed');
			}else{
				$('.panel-b-pre-fixed').removeClass('panel-b-fixed');
			}
		});


		var appPerfilEmpleado = new Vue({
			el: '#app-perfil',
			data:{
				templateMenu: "muro",
			},
			methods: {
				onClickMuro: function(){
					console.log('muro');
					appPerfilEmpleado.templateMenu = "muro";
				},
				onClickMensajes: function(){
					appPerfilEmpleado.templateMenu = "mensajes";
				},
				onClickAjustes: function(){
					appPerfilEmpleado.templateMenu = "ajustes";
				}
			}
		});
	</script>
@endsection