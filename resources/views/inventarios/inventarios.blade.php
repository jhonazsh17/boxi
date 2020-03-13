
<div class="home-sector-right_menu">
	<ul class="nav nav-pills">
	<li><a href="#" id="lista-inventarios" v-on:click="mostrarSectorInventarios()">Lista de Inventarios</a></li>
	  <li><a href="#" id="hacer-inventario" v-on:click="mostrarSectorHacerInventario()">Crear Inventario</a></li>
	  
	  
	</ul>
</div>

<div class="ventas-container">
	<div v-show="mostrarSectorHacerInventarioItem">
		
		<div class="text-center ventas-title">
			
			<div style="margin-bottom: .5em">
				<span  v-if="mostrarCrearInventario==true" >Crear Inventario</span>
				<span  v-else ><span id="titulo-tipo" style="font-size:1.2em"></span></span>	
			</div>
			
				
			<div v-if="mostrarCrearInventario==false">
				<span id="init" style="background: #eee;padding: 5px 10px;margin: 5px;color: #a6a6a6;border-radius: 2px;"></span> 
				<span id="finish" style="background: #e74c3c;padding: 5px 10px;margin: 5px;color: rgb(249, 249, 249);border-radius: 2px;"></span>
			</div>
			
			
		</div>

		<div class="row-fluid" v-if="mostrarCrearInventario" style="padding: 2px">
			
			<div class="col-md-12 col text-justify" style="color: rgb(129, 134, 138); margin-bottom: 1em; margin-top: 1em">	
				Se debe elegir el tipo de inventario y el rango de tiempo sobre el que se ejecutará el mismo. Una vez que pase el tiempo el inventario automáticamente se bloqueará, por lo tanto se debe ser cuidadoso al elegir el rango de tiempo.
			</div>
			<br>
			<div class="col-md-6 col">
				<div class="form-group">
					<label>Tipo de Inventario</label>
					<select name="	" id="" class="form-control form-esp" v-model="inventario.tipo">
						<option value="" disabled selected>Tipo Inventario</option>
						@foreach($tiposInv as $tipo)
						<option value="{{ $tipo->id }}">{{ $tipo->nombre }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group">
					<label>Inicio <small>(Fecha inicial)</small></label>
					<input type="date" class="form-control form-esp"  placeholder="Fecha Inicio" v-model="inventario.fechaInicio">
				</div>

				<div class="form-group">
					<label>Final <small>(Fecha final)</small></label>
					<input type="date" class="form-control form-esp" placeholder="Fecha Final" v-model="inventario.fechaFinal">
				</div>
			</div>
			<div class="col-md-6 col">
				<div class="form-group">
					<label>Observación</label>
					<textarea name="" id="" cols="30" rows="8" class="form-control form-esp" placeholder="Ingresa Observación" v-model="inventario.observacion"></textarea>
				</div>
			</div>
				
			<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token_inventario">

			<div class="row-fluid">	
				<div class="col-md-12 col text-left">	
					<button class="btn btn-default " v-on:click="crearInventario()">Crear Inventario</button>
				</div>
			</div>

		</div>

		<div v-else>
			<div class="col-md-4" id="mitad-1" style="padding:5px;">
				
				<div class="row-fluid">
					<div class="col-md-12 text-center suptitle">
						<h4>
							Agregar Productos a Inventario
						</h4>
					</div>
				</div>
				<br>
				<br>
				<div class="row fila-customize form-pretty">
					<div class="col-md-12 col" style="margin-bottom: .5em; color: #5e5a5a">
						DATOS DEL PRODUCTO
					</div>

					<div class="col-md-12 col">
						<div class="form-group">
							<label>Producto *</label>
							<input type="text" class="form-control form-esp" placeholder="Nombre de Producto" v-model="producto.producto" id="nombreProducto" v-on:keyup="keyGenerateCode()" style="text-transform:uppercase;" onkeydown="javascript:this.value=this.value.toUpperCase();">
						</div>
					</div>
				
					<div class="col-md-8 col">
							<div class="form-group">
								<label>Nombre Comercial</label>
								<input type="email" class="form-control form-esp" placeholder="Nombre Comercial" v-model="producto.nombre_comercial" style="text-transform:uppercase;" onkeydown="javascript:this.value=this.value.toUpperCase();">
							</div>
						</div>

						<div class="col-md-4 col">
							<div class="form-group">
								<label>Código *</label>
								<input type="text" class="form-control form-esp" placeholder="Código" v-model="producto.codigo" id="codigoProd" disabled>
							</div>
						</div>
							
						<div class="col-md-6 col">
							<div class="form-group">
								<label>Categoria *</label>	
								@if(count($categorias)>0)
								<select name="" id="" class="form-control form-esp" v-model="producto.id_categoria" v-on:change="onChangeCategoria">
									<option disabled value="">Elije una Categoría</option>
									@foreach($categorias as $categoria)
										<option value="{{ $categoria->id }}" >{{ $categoria->nombre }}</option>
									@endforeach
								</select>
								@else
									<div style="background: #ecf0f1; padding: 4px 10px; color: red; ">
										<a href="#" v-on:click="mostrarSectorCategoriaProductos()">Agregar Categorías</a>
									</div>
								@endif
							</div>
						</div>
							
						<div class="col-md-6 col">
							<div class="form-group">
								<label>Cant. Presentación *</label>
								<input type="number" class="form-control form-esp" placeholder="Cantidad" v-model="producto.cantidad" >
							</div>
						</div>

						<div class="col-md-6 col">
							<div class="form-group">
								<label>U. Medida *</label>
								@if(count($unidades)>0)
								<select name="" id="" class="form-control" v-model="producto.id_unidad" v-on:change="onChangeUnidad">
									<option disabled value="">Elije Unidad.</option>
									@foreach($unidades as $unidad)
										<option value="{{ $unidad->id }}">{{ $unidad->abreviatura }}</option>
									@endforeach 	
								</select>
								@else
									<div style="background: #ecf0f1; padding: 4px 10px; color: red; ">
										<a href="#" v-on:click="mostrarSectorUnidadesMedida()">Agregar Unidades</a>
									</div>
								@endif
							</div>
						</div>

						<div class="col-md-6 col">
							<div class="form-group">
								<label>Precio Unitario</label>
								<input type="number" step="0.01" class="form-control" placeholder="Precio Unitario (0.00)" v-model="producto.pUnitario" >
							</div>
						</div>
				</div>
				<div class="row fila-customize form-pretty">
					<div class="col-md-12 col">
						<div class="form-group">
							<label>Cantidad Contada</label>
							<input type="number" step="1" class="form-control" placeholder="Cantidad Contada del Producto" v-model="producto.stock" >
						</div>
					</div>
				</div>

				<div class="row fila-customize button-content-pretty">
					<div class="col-md-12 col text-center">
						<button class="btn btn-default" v-on:click="agregarProductoInventario()"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
						<button class="btn btn-sad"><i class="fa fa-eraser" aria-hidden="true"></i>Limpiar </button>
					</div>
					
				</div>
			</div>
			<div class="col-md-8" id="mitad-2" style="padding: 5px; border-left:1px solid #ddd; ">
				<div class="row-fluid">
					<div class="col-md-12 text-center suptitle">
						<h4>
							Items de Inventario
						</h4>
					</div>
					<div >
						<div class="row fila-customize button-content-pretty">
							<div class="row-fluid">
								<div class="col-md-3" style="padding: 0">
									Items: <span class="badge">@{{ agregar }}</span><br>
									<span><small>Almacén: <b>{{ $almacen->nombre }}</b></small></span>
								</div>
								<div class="col-md-9 text-right" style="padding: 0; margin-bottom: .5em">
									<span id="message-real-time" style="font-weight: bold;color: #929292;padding-right: 1em;"></span>
									<button class="btn btn-sm btn-sad" v-on:click="seleccionarClick()" id="seleccionar-varios-inventario" disabled><span class="glyphicon glyphicon-hand-up"></span> Seleccionar</button>
									<button class="btn btn-sm btn-sad" v-on:click="eliminarItemsInventario()" id="eliminar-varios-inventario" disabled><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
								</div>
							</div>
						</div>
							
							
						</div>

					<div v-if="mostrarAgregarProductosInventario!=3">
			 			<table class="table table-condensed table-striped table-hacer-venta" >
			 				<thead>
			 					<tr>
			 						<th></th>
			 						<th>N°</th>
			 						<th>Código</th>
			 						<th>Producto</th>
			 						<th>Nombre Comercial</th>
			 						<th>Categoría</th>
			 						<th>Presentación</th>
			 						<th>Precio Unit.</th>
			 						<th>Conteo</th>
			 						
			 						<th>Opciones</th>
			 					</tr>
			 				</thead>
			 				<tbody class="for-productos" v-if="mostrarAgregarProductosInventario==1">
			 					<tr >
			 						<td colspan="10"  class="color-d6 no-registros" style="height: 350px">
			 							<img class="producto-icon-sad" src="{{ asset('/img/sad.png') }}" alt="">
			 							<div>
			 								No se ha agregado productos aún. 
			 							</div>
			 							
			 						</td>
			 					</tr>
			 				</tbody>
			 				<tbody class="for-productos" style="border-bottom: 2px solid #bdc3c7" v-bind:style="styleScroll" v-if="mostrarAgregarProductosInventario==2" >
								<tr v-for="(producto, index) in productosInventario">
									<td>
										<div v-if="seleccionarActivate==true">
											<input type="checkbox" class="checky" v-on:click="clickCheck('#eliminar-varios-inventario')">
										</div>
									</td>
									<td>@{{ index+1 }}</td>
									<td>@{{ producto.codigo }}</td>
									<td style="text-align: left !important">@{{ producto.producto }}</td>
									<td style="text-align: left !important">@{{ producto.nombre_comercial }}</td>
									<td>@{{ producto.categoria }}</td>
									<td>@{{ producto.cantidad }} @{{ producto.unidad }}</td>
									<td>@{{ producto.pUnitario }}</td>
									<td style="background-color: #bdc3c7; color: black"><b>@{{ producto.stock }}</b></td>
									<td>
										<button class="btn btn-default btn-xs" v-bind:data-editar="producto.codigo" v-on:click="editarItemInventario(producto.codigo)">
								 			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								 		</button>
								 		
										<button class="btn btn-sad btn-xs" v-bind:data-editar="producto.codigo" v-on:click="eliminarItemInventario(producto.codigo)">
								 			<i class="fa fa-times" aria-hidden="true"></i>
								 		</button>
									</td>
								</tr>
			 				
			 					
			 				</tbody>
			 			</table >
			 		</div>
			 				<div v-if="mostrarAgregarProductosInventario==3">
			 					<table class="table table-condensed table-striped table-hacer-venta">
			 						<thead>
					 					<tr>
					 						<th>Código</th>
					 						<th>Producto</th>
					 						<th>Nombre Comercial</th>
					 						<th>Categoría</th>
					 						<th>Presentación</th>
					 						<th>Precio Unit.</th>
					 						<th>Conteo</th>
					 					</tr>
					 				</thead>
					 				<tbody>
					 					<tr>
									
											<td><i class="fa fa-arrow-right" style="color:#29db29"></i> @{{ inventarioItemEditar.codigo }}</td>
											<td style="text-align: left !important">@{{ inventarioItemEditar.producto }}</td>
											<td style="text-align: left !important">@{{ inventarioItemEditar.nombre_comercial }}</td>
											<td>@{{ inventarioItemEditar.categoria }}</td>
											<td>@{{ inventarioItemEditar.cantidad }} @{{ inventarioItemEditar.unidad }}</td>
											<td>@{{ inventarioItemEditar.pUnitario }}</td>
											<td>@{{ inventarioItemEditar.stock }}</td>
											
										</tr>
										<tr style="background: #a0ffec">
											<td colspan="7">
												<div class="row-fluid">
													<div class="col-md-12 text-left" style="font-size: 1.2em; color: rgb(77, 77, 77); margin-top: .3em; margin-bottom: .5em; text-decoration: underline;">
														
															EDITAR ITEM
														

													</div>
													
												</div>

												<div class="row-fluid">
													<div class="col-md-5 text-left" style="padding-right: .5em">
														<label for="">Producto</label>
														<input type="text" placeholder="Nombre de Producto" id="nombreProducto" class="form-control form-esp" v-model="inventarioItemEditar.producto" v-on:keyup="keyGenerateCodeEditarItemInv()">	
													</div>
													<div class="col-md-4 text-left" style="padding-right: .5em; padding-left: .5em">
														<label for="">Nombre Comercial</label>
														<input type="text" placeholder="Nombre Comercial" class="form-control form-esp" v-model="inventarioItemEditar.nombre_comercial">
													</div>
													<div class="col-md-3 text-left" style="padding-left: .5em">
														<label for="">Código</label>
														<input type="text" placeholder="Código" id="codigoProd" disabled="disabled" class="form-control form-esp" v-model="inventarioItemEditar.codigo">
													</div>
												</div>

												<div class="row-fluid">
													<div class="col-md-4 text-left" style="padding-right: .5em">
														<label for="">Categoría</label>
														<select name="" id="" class="form-control form-esp" v-model="provCategoriaInv" v-on:change="onChangeCategoriaItemEditInv()">
															<option  v-for="categoria in categorias"  v-bind:value="categoria.id">@{{ categoria.nombre }} </option>
														</select>
														
													</div>
													<div class="col-md-4 text-left" style="padding-right: .5em; padding-left: .5em">
														<label for="">Cant. Presentación</label>
														<input type="number" placeholder="Cant." class="form-control form-esp" v-model="inventarioItemEditar.cantidad">
													</div>
													<div class="col-md-4 text-left" style="padding-left: .5em">
														<label for="">Unidad de Medida</label>
														<select name="" id="" v-model="provUnidadInv" class="form-control form-esp" v-on:change="onChangeUnidadItemEditInv()">
															<option  v-for="unidad in unidades" v-bind:value="unidad.id">@{{ unidad.abreviatura }} </option>
														</select>
													</div>
												</div>

												<div class="row-fluid">
													<div class="col-md-3 text-left" style="padding-right: .5em">
														<label for="">Precio Unitario</label>
														<input type="number" step="0.01" placeholder="Precio" class="form-control form-esp" v-model="inventarioItemEditar.pUnitario">
														
													</div>
													<div class="col-md-3 text-left" style="padding-left: .5em">
														<label for="">Cantidad Contada</label>
														<input type="number" step="1" placeholder="Conteo" class="form-control form-esp" v-model="inventarioItemEditar.stock" s>
													</div>
													
												</div>
											</td>
											

											{{-- <td>
												<input type="text" placeholder="Código" id="codigoProd" disabled="disabled" class="form-control input-sm" style="width: 120px" v-model="inventarioItemEditar.codigo">
											</td> --}}
											{{-- <td>
												<input type="text" placeholder="Nombre de Producto" id="nombreProducto" class="form-control input-sm" style="width: 170px" v-model="inventarioItemEditar.producto" v-on:keyup="keyGenerateCodeEditarItemInv()">
											</td>
											<td>
												<input type="email" placeholder="Nombre Comercial" class="form-control input-sm" style="width: 130px" v-model="inventarioItemEditar.nombre_comercial">
											</td>
											<td>
												<select name="" id="" class="form-control input-sm" style="width: 100px" v-model="provCategoriaInv" v-on:change="onChangeCategoriaItemEditInv()">

													<option  v-for="categoria in categorias"  v-bind:value="categoria.id">@{{ categoria.nombre }} </option>
												</select>
											</td>
											<td>
												<di class="row-fluid">
													<div class="col-md-6" style="padding: 0">
														<input type="number" placeholder="Cant." class="form-control input-sm" v-model="inventarioItemEditar.cantidad">
													</div>
													<div class="col-md-6" style="padding-right: 0px;padding-left: 10px;">
														<select name="" id="" v-model="provUnidadInv" class="form-control input-sm" v-on:change="onChangeUnidadItemEditInv()">
															<option  v-for="unidad in unidades" v-bind:value="unidad.id">@{{ unidad.abreviatura }} </option>
														</select>
													</div>
												</di>
												
												
											</td>
											<td>
												<input type="number" step="0.01" placeholder="Precio" class="form-control input-sm" v-model="inventarioItemEditar.pUnitario" style="width: 70px">
											</td>
											<td>
												<input type="number" step="1" placeholder="Conteo" class="form-control input-sm" v-model="inventarioItemEditar.stock" style="width: 60px">
											</td> --}}
											
										</tr>
					 				</tbody>
			 					</table>
							

						</div>

						

			 			<div class="row fila-customize button-content-pretty">
			 				<div class="col-md-6" style="padding: 0">
			 					<button class="btn btn-default" v-on:click="guardarProductosInventario()" id="btn_guardar_varios"><i class="fa fa-floppy-o" aria-hidden="true" ></i> Guardar Productos </button>

			 				</div>
			 				<div class="col-md-6 text-right" style="padding: 0">

			 					<button v-if="mostrarAgregarProductosInventario==3" class="btn  btn-sad" v-on:click="cancelarEditarItemInv()" > Cancelar </button>
			 					<button v-if="mostrarAgregarProductosInventario==3" class="btn btn-default " v-on:click="guardarCambiosEditarItemInv()" > Guardar Cambios </button>

			 				</div>
			 				
			 			</div>
			 			
						<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token_productos_inventario">
						<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token_productos_inv">


				</div>
				<br>
			</div>

		</div>

		


	</div>

	<div v-show="mostrarSectorMensajeNoInventarioItem">
		@include('inventarios.mensaje_no_inventario')
	</div>

	<div v-show="mostrarSectorInventariosItem">
		@include('inventarios.lista_inventarios')
	</div>

	<div v-show="mostrarSectorEliminarInv">
		@include('inventarios.eliminar')
	</div>

</div>
