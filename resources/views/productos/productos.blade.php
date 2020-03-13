<!-- / Menú superior de item Productos / -->
<div class="home-sector-right_menu">
	<ul class="nav nav-pills">
	  {{-- <li><a href="#" v-on:click="mostrarSectorCrearProductos" v-bind:style="productosMenu.productoNuevo">Nuevo Producto</a></li> --}}
	  <li><a href="#" v-on:click="mostrarSectorProductos" v-bind:style="productosMenu.productos">Productos</a></li>
	  {{-- <li><a href="#" v-on:click="mostrarSectorCategoriaProductos" v-bind:style="productosMenu.categorias">Categorías de Productos</a></li>
	  <li><a href="#" v-on:click="mostrarSectorUnidadesMedida" v-bind:style="productosMenu.unidades">Unidades de Medida</a></li> --}}
	</ul>
</div>
<!-- / Fin / -->

<!-- / Contenedor principal de Productos / -->
<div class="ventas-container">
	<div v-show="mostrarSectorCrearProductosItem">
		<div class="text-center ventas-title">
			Nuevo Producto
		</div>

		<div class="row-fluid">
			<!-- / Mitad en la que se muestra el formulario / -->
			<div class="col-md-8" id="mitad-1" style="padding:10px;">
					<br>

					<div class="row fila fila-customize">

						<div class="col-md-4 col">
							<div class="form-group">
								<label>Opción</label>
								<select name="" id="" class="form-control input-sm" v-model="mostrarOpcion" v-on:change="accionMostrarOpcion">
								    <option disabled value="">Elije una Opción</option>
									<option value="1">Un producto</option>
									<option value="2">Varios productos</option>
								</select>
							</div>

						</div>
							
						<!-- / Input que se muestra eligiendo opción: "varios productos" / -->
						<div v-show="mostrarOpcion==2">
							<div class="col-md-2 col">
								<div class="form-group">
									<label>Cuántos?</label>
									<input type="number" class="form-control input-sm" min="1" max="10" placeholder="Max. 10" value="1" id="numberCuantos">   	
								</div>
							</div>

							<div class="col-md-3 col">
								<div class="producto-msg-input-cuantos">
									Hasta 10 productos
								</div>
							</div>
						</div>
						<!-- / Fin / -->

					</div>

					<div class="row fila fila-customize">

						<div class="col-md-12 col">
							<div class="form-group">
								<label>Producto *</label>
								<input type="text" class="form-control input-sm" placeholder="Nombre de Producto" v-model="producto.producto" id="nombreProducto" v-on:keyup="keyGenerateCode()">
							</div>
						</div>

						<div class="col-md-9 col">
							<div class="form-group">
								<label>Nombre Comercial</label>
								<input type="email" class="form-control input-sm" placeholder="Nombre Comercial" v-model="producto.nombre_comercial" >
							</div>
						</div>

						<div class="col-md-3 col">
							<div class="form-group">
								<label>Código *</label>
								<input type="text" class="form-control input-sm" placeholder="Código" v-model="producto.codigo" id="codigoProd" disabled>
							</div>
						</div>
							
						<div class="col-md-4 col">
							<div class="form-group">
								<label>Categoria *</label>	
								@if(count($categorias)>0)
								<select name="" id="" class="form-control input-sm" v-model="producto.id_categoria" v-on:change="onChangeCategoria">
									<option disabled value="">Elije una Categoría</option>
									@foreach($categorias as $categoria)
										<option value="{{ $categoria->id }}" >{{ $categoria->nombre_categoria }}</option>
									@endforeach
								</select>
								@else
									<div style="background: #ecf0f1; padding: 4px 10px; color: red; ">
										<a href="#" v-on:click="mostrarSectorCategoriaProductos">Agregar Categorías</a>
									</div>
								@endif
							</div>
						</div>
							
						<div class="col-md-3 col">
							<div class="form-group">
								<label>Cant. Presentación *</label>
								<input type="text" class="form-control input-sm" placeholder="Cantidad" v-model="producto.cantidad" >
							</div>
						</div>

						<div class="col-md-2 col">
							<div class="form-group">
								<label>U. Medida *</label>
								@if(count($unidades)>0)
								<select name="" id="" class="form-control input-sm" v-model="producto.id_unidad" v-on:change="onChangeUnidad">
									<option disabled value="">Elije Unidad.</option>
									@foreach($unidades as $unidad)
										<option value="{{ $unidad->id }}">{{ $unidad->abreviatura }}</option>
									@endforeach 	
								</select>
								@else
									<div style="background: #ecf0f1; padding: 4px 10px; color: red; ">
										<a href="#" v-on:click="mostrarSectorUnidadesMedida">Agregar Unidades</a>
									</div>
								@endif
							</div>
						</div>

						<div class="col-md-3 col">
							<div class="form-group">
								<label>Precio Unitario</label>
								<input type="text" class="form-control input-sm" placeholder="Precio Unitario" v-model="producto.pUnitario" >
							</div>
						</div>
							
					</div>

					<div class="row">
						<div class="col-md-12 text-center" style="color:red; display: none" id="cont-msg-form">
							<span id="msg-form-prod" ></span>
						</div>
					</div>

					<div class="row" style="margin-top:1em">

						<!-- / Botones que se muestran eligiendo opción "Varios Productos" / -->
						<div v-show="mostrarOpcion==2">
							<div class="col-md-12 col text-center">
								<button class="btn btn-default btn-sm" v-on:click="agregarProducto"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Producto</button>
								<button class="btn btn-sad btn-sm" v-on:click="limpiarFormProducto"><i class="fa fa-eraser" aria-hidden="true"></i> Limpiar </button>
							</div>
						</div>
						<!-- / Fin / -->

						<!-- / Botones que se muestran eligiendo opción "Un Producto" / -->
						<div v-show="mostrarOpcion==1">
							<div class="col-md-12 text-center">
								<button class="btn btn-default btn-sm" v-on:click="guardarProducto"> <i class="fa fa-floppy-o" aria-hidden="true" ></i> Guardar Producto </button>

								<button class="btn btn-default btn-sm" ><i class="fa fa-floppy-o" aria-hidden="true" ></i> <i class="fa fa-plus" aria-hidden="true"></i> Guardar Producto y Seguir </button>

								<button class="btn btn-sad btn-sm"><i class="fa fa-eraser" aria-hidden="true"></i>Limpiar </button>
							</div>
						</div>
						<!-- / Fin / -->

					</div>
					  
					<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token_producto">

				

			</div>
			<!-- / Fin / -->
		
			<!-- / Segunda Mitad que muestra "vistazo de producto" o "lista de productos agregar" / -->
			<div class="col-md-4" style="padding: 10px; border-left:1px solid rgb(189, 195, 199); padding-bottom: 2em" id="mitad-2">
				<div class="ventas-table">

					<!-- / Vistazo del Producto que se muestra con la opción "Un producto" / -->
					<div v-show="mostrarOpcion==1" id="cargar">
						<br>
						<div class="row-fluid">
							<div class="col-md-12 text-center">
								<h4>
									Vistazo del Producto
								</h4>
							</div>
						</div>
						
						<div class="row-fluid" v-show="no_loading">
							<div class="col-md-10 col-md-offset-1">
								
								<div class="row">
									<div class="col-md-12 text-center" style="margin-top: 1em">

										<i v-if="producto.codigo=='' && producto.producto=='' && producto.nombre_comercial=='' " class="fa fa-cubes" aria-hidden="true" style="font-size:12em;color:#d6d6d6" ></i>

										<i v-else class="fa fa-cubes" aria-hidden="true" style="font-size:12em;color:#f1c40f" ></i>

									</div>

									<div class="col-md-12" style="margin-top: 1em">
										
										<p class="producto-uno-parent">
											<span v-if="producto.producto==''" class="producto-uno">
												Nombre de Producto
											</span>
											<span v-else>
												@{{ producto.producto }}
											</span>
											
										</p>
										<p class="producto-uno-parent">
											<span v-if="producto.nombre_comercial==''" class="producto-uno">
												Nombre Comercial 
											</span>
											<span v-else>
												@{{ producto.nombre_comercial }}
											</span>
											
										</p>
										<p class="producto-uno-parent">
											<span v-if="producto.codigo==''" class="producto-uno">
												Código
											</span>
											<span v-else>
												@{{ producto.codigo }}
											</span>
											
										</p>
										<p class="producto-uno-parent">
											<span v-if="producto.categoria==''" class="producto-uno">
												Categoría
											</span>
											<span v-else>

												<span v-show="loading_message">
													<img src="{{ asset('img/loading.GIF') }}" width="20px">
												</span>
												<span v-show="no_loading_message">
													@{{ producto.categoria }}
												</span>
												
												
											</span>
											
										</p>
										<p class="producto-uno-parent">
											<span v-if="producto.cantidad==''" class="producto-uno">
												Presentación 
											</span>
											<span v-else>
												@{{ producto.cantidad }} 

												<span v-show="loading_message_und">
													<img src="{{ asset('img/loading.GIF') }}" width="20px">
												</span>
												<span v-show="no_loading_message_und">
													@{{ producto.unidad }}
												</span>
											</span>
											
										</p>
										<p class="producto-uno-parent">
											<span v-if="producto.pUnitario==''" class="producto-uno">
												Precio Unitario 
											</span>
											<span v-else>
												@{{ producto.pUnitario }} 
											</span>
											
										</p>

									</div>
								</div>

							</div>
							
						</div>


						<div class="row-fluid" v-show="loading">
							<div class="col-md-8 col-md-offset-2 text-center" style="margin-top:2em">
								<img  src="{{ asset('img/loading.GIF') }}" width="30px">
								
							</div>
						</div>

					</div>
					<!-- / Fin / -->
					
					<!-- / Tabla donde se muestra los varios productos agregar / -->
					<div v-show="mostrarOpcion==2">

						<div style="margin-top: 1em; margin-bottom: 2em">
							<div class="row-fluid">
								<div class="col-md-6" style="padding: 0">
									Productos: <span class="badge">@{{ agregar }}</span>
								</div>
								<div class="col-md-6 text-right" style="padding: 0; margin-bottom: .5em">
									<button class="btn btn-sm btn-sad" v-on:click="seleccionarClick()" id="seleccionar-varios" disabled><span class="glyphicon glyphicon-hand-up"></span> Seleccionar</button>
									<button class="btn btn-sm btn-sad" v-on:click="eliminarClick()" id="eliminar-varios" disabled><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
								</div>
							</div>
							
						</div>

			 			<table class="table table-condensed table-striped table-hacer-venta" >
			 				<thead>
			 					<tr>
			 						<th></th>
			 						<th><small>N°</small></th>
			 						<th><small>Código</small></th>
			 						<th><small>Producto</small></th>
			 						<th><small>Nombre Comercial</small></th>
			 						<th><small>Categoría</small></th>
			 						<th><small>Presentación</small></th>
			 						<th><small>Precio Unit.</small></th>
			 						
			 						<th><small>Opciones</small></th>
			 					</tr>
			 				</thead>
			 				<tbody class="for-productos" v-if="mostrarAgregarProductosItem">
			 					<tr >
			 						<td colspan="8"  class="color-d6 no-registros" style="height: 350px">
			 							<img class="producto-icon-sad" src="{{ asset('/img/sad.png') }}" alt="">
			 							<div>
			 								No se ha agregado productos aún. 
			 							</div>
			 							
			 						</td>
			 					</tr>
			 	
			 				</tbody>

			 				<tbody class="for-productos" v-else>
			 					@include('productos/varios_productos')
			 				</tbody>

			 			</table>

						<div class="row-fluid">
							<div class="col-md-10 col-md-offset-1 text-center">
								<div id="msg_auxiliar">
									
								</div>

								<button class="btn btn-default btn-sm" v-on:click="guardarVariosProductos()" id="btn_guardar_varios"><i class="fa fa-floppy-o" aria-hidden="true" ></i> Guardar Productos </button>
								
								<div id="msg_guardar_varios">
									
								</div>
								<div>
									<img  src="{{ asset('img/loading.GIF') }}" alt="" style="width: 30px;display: none" id="load_guardar_varios">
								</div>
								
							</div>
						</div>

						<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token_varios">
					
		 			</div>
		 			<!-- / Fin / -->

				</div>

			</div>

		</div>
	</div>

	<div v-show="mostrarSectorProductosItem">
		@include('productos/lista_productos')
	</div>

	<div v-show="mostrarSectorCategoriaProductosItem">
		@include('productos/categorias')
	</div>

	<div v-show="mostrarSectorUnidadesMedidaItem">
		@include('productos/unidades_medida')
	</div>
</div>