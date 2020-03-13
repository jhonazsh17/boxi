<div class="home-sector-right_menu">
	<ul class="nav nav-pills">
	  <li><a href="#hacer-venta" v-on:click="mostrarSectorHacerVenta()" id="hacer-venta">Hacer Venta</a></li>
	  <li><a href="#ventas" v-on:click="mostrarSectorVentas()" id="ver-ventas">Ventas</a></li>
	</ul>
</div>

<div class="ventas-container">
	<div v-show="mostrarSectorHacerVentaItem">
		<div class="text-center ventas-title">
			<i class="fa fa-handshake-o" aria-hidden="true" style="font-size: 1.2em"></i> &nbsp;&nbsp;Hacer Venta
		</div>

		<div class="row-fluid">
			<div class="col-md-4" id="mitad-1" style="padding:5px;">
						<div class="row-fluid">
							<div class="col-md-12 text-center suptitle">
								<h4>
									Agregar Productos para Venta
								</h4>
							</div>
						</div>
						<br>
						<br>
					
						<div class="row fila-customize form-pretty">
							
							<div class="col-md-5 col">
								<div class="form-group">
								    <label>Tipo de Venta *</label>
								    {{-- <input type="email" class="form-control input-sm" id="exampleInputEmail1" placeholder="Producto"> --}}
								    <select name=""  class="form-control" v-model="venta.tipo">
								    	<option value="1" >Venta Rápida</option>
								    	<option value="2">Contado</option>
								    	<option value="3">Credito 7 días</option>
								    	<option value="4">Credito 15 días</option>
								    	<option value="5">Credito 30 días</option>
								    </select>
								</div>
							</div>
							<div class="col-md-7 text-right" style="padding-top: 1.5em">
								<div class="checkbox">
								    <label>
								      <input type="checkbox" id="checkConsumo" v-on:click="clickConsumoPropio()"> Consumo Propio
								    </label>
								</div>
							</div>
							
							
							
						</div>
						<div class="row fila-customize form-pretty" v-show="consumo==true">
							<div class="col-md-12 col" style="margin-bottom: .5em; color: #5e5a5a">
								DATOS DOCUMENTO
							</div>
							<div class="col-md-4 col">
								<div class="form-group">
								    <label>N° Doc. *</label>
								    <input type="text" class="form-control " placeholder="N° Doc." v-model="venta.nroDoc">
								</div>
							</div>
							<div class="col-md-8 col">
								<div class="form-group">
								    <label>Documento *</label>
								    <select name="" class="form-control" v-model="venta.tipoDoc">
								    	<option value="Boleta de Venta" >Boleta de Venta</option>
								    	<option value="Factura" v-show="venta.tipo!=1">Factura</option>
								    	
								    </select>
								</div>
							</div>
							
							
							
							
							
						</div>
						<div class="row fila-customize form-pretty" v-show="venta.tipo!=1">
							<div class="col-md-12 col" style="margin-bottom: .5em; color: #5e5a5a">
								DATOS DEL CLIENTE | <button class="btn btn-link btn-xs">+ Cliente</button>
							</div>
							<div class="col-md-4 col">
								<div class="form-group">
								    <label>DNI/RUC *</label>
								    {{-- <input type="text" class="form-control input-sm" id="cli"  placeholder="DNI Cliente" v-model="venta.doc"> --}}
								    <my-autocomplete2></my-autocomplete2>
								</div>
							</div>
							<div class="col-md-8 col">
								<div class="form-group">
								    <label>Cliente *</label>
								    <input type="text" class="form-control" id="dc" placeholder="Ingresar Cliente" v-model="venta.cliente">
								</div>
							</div>
							
							
							
							
						</div>

						
						
						
						<div class="row fila-customize form-pretty" >
							<div class="col-md-12 col" style="margin-bottom: .5em; color: #5e5a5a">
								ITEMS
							</div>
							<div class="col-md-2 col">
								<div class="form-group">
								    <label>Cant. *</label>
								    <input type="number" class="form-control" placeholder="Cantidad" v-model="productoVenta.cantidad">
								</div>
							</div>
							<div class="col-md-7 col">
								<div class="form-group">
								    <label>Producto *</label>
								    {{-- <input type="email" class="form-control input-sm" id="exampleInputEmail1" placeholder="Producto" v-model="productoVenta.producto"> --}}
								    {{-- <input type="email" class="form-control input-sm" placeholder="Producto" > --}}
								    <my-autocomplete></my-autocomplete>
								</div>
							</div>

							<div class="col-md-3 col">
								<div class="form-group">
								    <label>Stock</label>
								    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Stock" disabled v-model="stocksito">
								</div>
							</div>
							
							
							
							
						</div>

						
						<div class="row fila-customize button-content-pretty">
							<div class="col-md-12 text-center">
								<!-- Mensaje -->
								<div v-if="messageErrorStock==true" style="margin-bottom: .7em; color:red">
									<b>Cantidad</b> no permitida. Excede al <b>Stock</b>.
								</div>

								<div v-if="messageErrorVacioVenta==true" style="margin-bottom: .7em; color:red">
									Hay campos vacíos. 
								</div>

								<button class="btn btn-default" v-on:click="clickAgregarProductoVenta()"><i class="fa fa-plus" aria-hidden="true"></i> Agregar </button>
								<button class="btn btn-sad">Limpiar </button>
								
							</div>
						</div>
					  
					  
					  
					  
		 			
				
			</div>

			<div class="col-md-8" id="mitad-2" style="padding: 5px; border-left:1px solid #ddd; padding-bottom: 2em">

				
				<div class="row-fluid">
					<div class="col-md-12 text-center suptitle">
						<h4>
							Items para Venta
						</h4>
					</div>
				</div>
				
				<div class="row fila-customize button-content-pretty">
					<div class="row-fluid">
						<div class="col-md-6" style="padding: 0">
							Listado de Items de productos para venta.
						</div>
						<div class="col-md-6 text-right" style="padding: 0; margin-bottom: .5em">
							<button class="btn btn-sm btn-sad" v-on:click="seleccionarClick()" id="seleccionar-varios" disabled><span class="glyphicon glyphicon-hand-up"></span> Seleccionar</button>
							<button class="btn btn-sm btn-sad" v-on:click="eliminarClick()" id="eliminar-varios" disabled><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
						</div>
					</div>
							
				</div>

				<table class="table table-condensed table-hover table-striped table-hacer-venta" style="margin-bottom: 0">
			 		<thead>
			 			<tr>
			 				<th></th>
			 				<th>Cantidad</th>
			 				<th>Producto</th>
			 				<th>Precio Unit.</th>
			 				<th>Monto</th>
			 				<th>Opciones</th>
			 			</tr>
			 		</thead>

			 		<tbody class="for-productos" v-if="mostrarAgregarProductosItem">
			 			<tr >
			 				<td colspan="6"  class="color-d6 no-registros" style="height: 300px">
			 					<img class="producto-icon-sad" src="{{ asset('/img/sad.png') }}" alt="">
			 					<div>
			 						No se ha agregado productos aún. 
			 					</div>
			 							
			 				</td>
			 			</tr>
			 	
			 		</tbody>

			 		<tbody class="for-productos" v-else>
						@include('ventas/items')
			 		</tbody>


			 	</table>

			 	<div class="row-fluid">
			 		<div class="col-md-12" style="background-color: rgb(236, 240, 241); margin-bottom: 1em; border-bottom: 1px solid #bdc3c7;">
			 			<div class="row">
			 				<div class="col-md-6" style="margin-top: 1em">
					 			Productos: <span class="badge">@{{ itemsVenta.length }}</span>
					 		</div>
							<div class="col-md-6 text-right" style="margin-bottom: 1em">
								<span style="font-size: 2em">S/. @{{ totalVenta }}</span>
								<div>
									<span><small>Nuevos Soles</small></span>
								</div>
							</div>
			 			</div>
			 			
			 		</div>
			 		
				</div>
				
				<div class="row fila-customize button-content-pretty " >
					<div class="col-md-12 text-center">
						<button class="btn btn-default " v-on:click="onClickGuardarVenta()">Guardar Venta </button>

					</div>
				</div>
				
				<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token_venta">
				

			</div>
		
		
		
 		</div>
	</div>
	<div v-show="mostrarSectorVentasItem" >
		<div class="text-center ventas-title">
			<i class="fa fa-handshake-o" aria-hidden="true" style="font-size: 1.2em"></i> &nbsp;&nbsp;Ventas
		</div>
		
		<div>

			<div class="ventas-table" style="padding-right: 5px; padding-left: 5px; padding-top: 10px" v-show="tablaVentas==1">
				
				<div style="color:#464646;">
					<div class="row-fluid" >
						<div class="col-md-8" style="padding: 0; padding-bottom: 10px">
							Lista de todas las <b>Ventas Registradas</b>.
						</div>
						<div class="col-md-4 text-right" style="padding: 0; padding-bottom: 10px">
							<div class="row-fluid">
								
								<div class="col-md-8" style="padding-right: 3px">
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-filter"></span></span>
									  <input type="date" class="form-control input-sm" v-on:change="onChangeVentaDia()" v-model="ventaDia" >
									</div>
									
								</div>
								<div class="col-md-4" style="padding-left: 2px; padding-right: 2px">
									<button class="btn btn-sad btn-sm btn-block" v-on:click="onClickVentaDelDia()">Ventas de Hoy</button>
								</div>
								
							</div>
							

							
						</div>
					</div>
					
				</div>

	 			<table class="table table-condensed table-hover table-ventas" id="table-ventas" >
	 				<thead>
	 					<tr>
	 						<th></th>
	 						<th>N°</th>
	 						<th>Fecha y Hora - Venta</th>
	 						<th>Tipo Venta</th>
	 						<th>Documento</th>
	 						<th>Cliente</th>
	 						<th>Productos</th>
	 						<th>Monto (S/.)</th>	 						
	 						<th>Fecha y Hora - Modificación</th>
	 						<th>Opciones</th>
	 					</tr>
	 				</thead>
	 				
	 			</table>
	 		</div>

	 		<div class="ventas-table" style="padding-right: 5px; padding-left: 5px; padding-top: 10px" v-show="tablaVentas==3">
	 			<div style="color:#464646;">
					<div class="row-fluid" >
						<div class="col-md-8" style="padding: 0; padding-bottom: 10px">
							Lista de Todas las <b>Ventas de Hoy : <span style="text-decoration: underline"><?php echo date('d-m-Y'); ?></span></b>. | Total: <span id="totalVentasHoy" style="font-size: 1.5em"><b></b></span> Soles.
						</div>
						<div class="col-md-4 text-right" style="padding: 0; padding-bottom: 10px">

							
							<div class="row-fluid">
								
								<div class="col-md-6" style="padding-right: 3px">
									
								</div>
								<div class="col-md-6" style="padding-left: 2px; padding-right: 2px">
									<button class="btn btn-sad btn-sm btn-block" v-on:click="volverSectorVentas()"><i class="fa fa-arrow-circle-left"></i> Volver a Todas las Ventas </button>
								</div>
								
							</div>
						</div>
					</div>
					
				</div>

				<table class="table table-condensed table-hover table-ventas" id="table-ventas-hoy" >
	 				<thead>
	 					<tr>
	 						<th></th>
	 						<th>N°</th>
	 						<th>Fecha y Hora - Venta</th>
	 						<th>Tipo Venta</th>
	 						<th>Documento</th>
	 						<th>Cliente</th>
	 						<th>Productos</th>
	 						<th>Monto (S/.)</th>	 						
	 						<th>Fecha y Hora - Modificación</th>
	 						<th>Opciones</th>
	 					</tr>
	 				</thead>
	 				
	 			</table>
	 		</div>

	 		<div class="ventas-table" style="padding-right: 5px; padding-left: 5px; padding-top: 10px" v-show="tablaVentas==4">
	 			<div style="color:#464646;">
					<div class="row-fluid" >
						<div class="col-md-7" style="padding: 0; padding-bottom: 10px">
							Lista de Todas las <b>Ventas del Dia : <span style="text-decoration: underline" id="dateDia"></span></b>. | Total: <span id="totalVentasDia" style="font-size: 1.5em"><b></b></span> Soles.
						</div>
						<div class="col-md-5 text-right" style="padding: 0; padding-bottom: 10px">

							
							<div class="row-fluid">
								
								<div class="col-md-6" style="padding-right: 3px">
									<div class="input-group">
									  <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-filter"></span></span>
									  <input type="date" class="form-control input-sm" v-on:change="onChangeVentaDia()" v-model="ventaDia" >
									</div>
								</div>
								<div class="col-md-6" style="padding-left: 2px; padding-right: 2px">
									<button class="btn btn-sad btn-sm btn-block" v-on:click="volverSectorVentas()"><i class="fa fa-arrow-circle-left"></i> Volver a Todas las Ventas </button>
								</div>
								
							</div>
						</div>
					</div>
					
				</div>

				<table class="table table-condensed table-hover table-ventas" id="table-ventas-dia" >
	 				<thead>
	 					<tr>
	 						<th></th>
	 						<th>N°</th>
	 						<th>Fecha y Hora - Venta</th>
	 						<th>Tipo Venta</th>
	 						<th>Documento</th>
	 						<th>Cliente</th>
	 						<th>Productos</th>
	 						<th>Monto (S/.)</th>	 						
	 						<th>Fecha y Hora - Modificación</th>
	 						<th>Opciones</th>
	 					</tr>
	 				</thead>
	 				
	 			</table>
	 		</div>

	 		<div class="ventas-table" style="padding-right: 5px; padding-left: 5px; padding-top: 10px" v-show="tablaVentas==2">

	 			<div class="row-fluid">
	 				<div class="col-md-6" style="padding: 0; padding-bottom: 10px">
	 					<span style="color:#464646">Detalle rápido de <b>Items de Venta</b>.</span>
	 				</div>
	 				<div class="col-md-6 text-right" style="padding: 0; padding-bottom: 10px">
	 					<button class="btn btn-sad btn-sm" v-on:click="volverSectorVentas()"><i class="fa fa-arrow-circle-left"></i> Volver a Ventas </button>
	 				</div>
	 				
	 			</div>
	 			

	 			<table class="table table-condensed table-hover table-ventas" id="table-ventas" style="margin-top: 10px">
	 				<thead>
	 					<tr>
	 						<th>Fecha y Hora - Venta</th>
	 						<th>Tipo Venta</th>
	 						<th>Documento</th>
	 						<th>Cliente</th>
	 						<th>Productos</th>
	 						<th>Monto (S/.)</th>
	 						
	 						<th>Fecha y Hora - Modificación</th>
	 						<th>Opciones</th>
	 					</tr>
	 				</thead>

	 				<tbody>
	 					<tr>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td>
	 							<button class="btn btn-default btn-xs" style="background: #e67e226b;border-color: #c0392b2e;" disabled><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs" style="background-color: #1abc9c59;border: 1px solid #16a0852b;" disabled><i class="fa fa-trash" aria-hidden="true"></i> </button>
	 						</td>
	 					</tr>
	 					<tr>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td>
	 							<button class="btn btn-default btn-xs" style="background: #e67e226b;border-color: #c0392b2e;" disabled><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs" style="background-color: #1abc9c59;border: 1px solid #16a0852b;" disabled><i class="fa fa-trash" aria-hidden="true"></i> </button>
	 						</td>
	 					</tr>
	 					<tr style="background: #fdfdf0">
	 						<td>@{{ verVenta.created_at }}</td>
	 						<td><a href='#' style='color:#5c71da'>@{{ verVenta.tipo }}</a></td>
	 						<td><a href='#' style='color:#4b4b80'>@{{ verVenta.doc }}</a></td>
	 						<td><a href='#' style='color:#4b4b80'>@{{ verVenta.cliente }}</a></td>
	 						<td>
	 							<ul class="list-group">
								  <li class="list-group-item" v-for="item in verVenta.items">@{{ item.cantidad }} - @{{ item.nombre }} @{{ item.cantidad_presentacion }} @{{ item.unidad}} - <b>S/. @{{ item.precio }}</b> <span class="badge">S/. @{{ item.submonto}}</span></li>
								</ul>
	 							
	 						</td>
	 						<td><b>S/. @{{ verVenta.monto }}</b></td>
	 						
	 						<td>@{{ verVenta.updated_at }}</td>
	 						<td>
	 							<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> </button>
	 						</td>
	 					</tr>
	 					<tr>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td>
	 							<button class="btn btn-default btn-xs" style="background: #e67e226b;border-color: #c0392b2e;" disabled><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs" style="background-color: #1abc9c59;border: 1px solid #16a0852b;" disabled><i class="fa fa-trash" aria-hidden="true"></i> </button>
	 						</td>
	 					</tr>
	 					<tr style="border-bottom: 1px solid #ddd">
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td style="color:#bbb">...</td>
	 						<td>
	 							<button class="btn btn-default btn-xs" style="background: #e67e226b;border-color: #c0392b2e;" disabled><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs" style="background-color: #1abc9c59;border: 1px solid #16a0852b;" disabled><i class="fa fa-trash" aria-hidden="true"></i> </button>
	 						</td>
	 					</tr>
	 				</tbody>
	 				
	 			</table>
				
	 			<div class="text-left" style="margin-top: 10px">
	 				<button class="btn btn-sad btn-sm" v-on:click="volverSectorVentas()"><i class="fa fa-arrow-circle-left"></i> Volver a Ventas </button>
	 			</div>
	 		</div>
		</div>
	</div>
	
	
</div>

