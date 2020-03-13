
		<div class="text-center ventas-title">
			<i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 1.2em"></i> &nbsp;&nbsp;Efectuar Compra
		</div>

		<div class="row-fluid">
			<div class="col-md-4" id="mitad-1" style="padding:5px;">
						<div class="row-fluid">
							<div class="col-md-12 text-center suptitle">
								<h4>
									Agregar Productos para Compra
								</h4>
							</div>
						</div>
						<br>
						<br>
					
						

						<div class="row fila-customize form-pretty" >
							<div class="col-md-12 col" style="margin-bottom: .5em; color: #5e5a5a">
								DATOS DOCUMENTO
							</div>
							<div class="col-md-4 col">
								<div class="form-group">
								    <label>N° Doc. *</label>
								    <input type="text" class="form-control " placeholder="N° Doc." v-model="compra.nroDoc">
								</div>
							</div>
							<div class="col-md-8 col">
								<div class="form-group">
								    <label>Documento *</label>
								    <select name="" class="form-control" v-model="compra.tipoDoc">
								    	<option value="Boleta de Venta" >Boleta de Venta</option>
								    	<option value="Factura" >Factura</option>
								    	
								    </select>
								</div>
							</div>
							
							
							
							
							
						</div>
						<div class="row fila-customize form-pretty" >
							<div class="col-md-12 col" style="margin-bottom: .5em; color: #5e5a5a">
								DATOS DEL PROVEEDOR | <button class="btn btn-link btn-xs">+ Proveedor</button>
							</div>
							<div class="col-md-4 col">
								<div class="form-group">
								    <label>DNI/RUC *</label>
								    {{-- <input type="text" class="form-control " id="cli"  placeholder="DNI Cliente" v-model="venta.doc"> --}}
								    <my-autocomplete3></my-autocomplete3>
								</div>
							</div>
							<div class="col-md-8 col">
								<div class="form-group">
								    <label>Proveedor *</label>
								    <input type="text" class="form-control " id="dc" placeholder="Ingresar Proveedor" v-model="compra.proveedor">
								</div>
							</div>
							
							
							
							
						</div>

						
						
						
						<div class="row fila-customize form-pretty" >
							<div class="col-md-12 col" style="margin-bottom: .5em; color: #5e5a5a">
								ITEMS | <button class="btn btn-link btn-xs" >+ Producto</button>
							</div>
							<div class="col-md-3 col">
								<div class="form-group">
								    <label>Cant. *</label>
								    <input type="number" class="form-control form-esp" placeholder="Cantidad" v-model="productoCompra.cantidad">
								</div>
							</div>
							<div class="col-md-9 col">
								<div class="form-group form-esp">
								    <label>Producto *</label>
								    {{-- <input type="email" class="form-control " id="exampleInputEmail1" placeholder="Producto" v-model="productoVenta.producto"> --}}
								    {{-- <input type="email" class="form-control " placeholder="Producto" > --}}
								    <my-autocomplete4></my-autocomplete4>
								</div>
							</div>

							<div class="col-md-6 col">
								<div class="form-group">
								    <label>Precio Compra &nbsp;<i class="fa fa-calculator litle-btn"  data-toggle="modal" data-target="#myModalCalcular" title="Calcular Precio de Compra"></i></label>
								    <input type="number" class="form-control " placeholder="Precio de Compra" v-model="productoCompra.pCompra">
								</div>
							</div>

							<div class="col-md-6 col">
								<div class="form-group">
								    <label>Precio Venta &nbsp;<i class="fa fa-calculator litle-btn" title="Calcular Precio Venta" ></i></label>
								    <input type="number" class="form-control "  placeholder="Precio de Venta" >
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

								<button class="btn btn-default " v-on:click="clickAgregarProductoCompra()"><i class="fa fa-plus" aria-hidden="true"></i> Agregar </button>
								<button class="btn btn-sad ">Limpiar </button>
								
							</div>
						</div>
					  
					  
					  
					  
		 			
				
			</div>

			<div class="col-md-8" id="mitad-2" style="padding: 5px; border-left:1px solid #ddd; padding-bottom: 2em">

				
				<div class="row-fluid">
					<div class="col-md-12 text-center suptitle">
						<h4>
							Items para Compra
						</h4>
					</div>
				</div>
				
				<div class="row fila-customize button-content-pretty">
					<div class="row-fluid">
						<div class="col-md-6" style="padding: 0; color: #464646">
							Listado de Items de productos para venta.
						</div>
						<div class="col-md-6 text-right" style="padding: 0; margin-bottom: .5em">
							<button class="btn btn-sm btn-sad" v-on:click="seleccionarClick()" id="seleccionar-varios" disabled><span class="glyphicon glyphicon-hand-up"></span> Seleccionar</button>
							<button class="btn btn-sm btn-sad" v-on:click="eliminarClick()" id="eliminar-varios" disabled><span class="glyphicon glyphicon-trash"></span> Eliminar</button>
						</div>
					</div>
							
				</div>

				<table class="table table-condensed table-striped table-hacer-venta" style="margin-bottom: 0">
			 		<thead>
			 			<tr>
			 				<th></th>
			 				<th>Cantidad</th>
			 				<th>Producto</th>
			 				<th>Precio Compra</th>
			 				<th>Monto</th>
			 				<th>Opciones</th>
			 			</tr>
			 		</thead>

			 		<tbody class="for-productos" v-if="mostrarAgregarProductosComprasItem">
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
						@include('compras/items')
			 		</tbody>


			 	</table>

			 	<div class="row-fluid">
			 		<div class="col-md-12" style="background-color: rgb(236, 240, 241); margin-bottom: 1em; border-bottom: 1px solid #bdc3c7;">
			 			<div class="row">
			 				<div class="col-md-6" style="margin-top: 1em">
					 			Productos: <span class="badge">@{{ itemsCompra.length }}</span>
					 		</div>
							<div class="col-md-6 text-right" style="margin-bottom: 1em">
								<span style="font-size: 2em">S/. @{{ totalCompra }}</span>
								<div>
									<span><small>Nuevos Soles</small></span>
								</div>
							</div>
			 			</div>
			 			
			 		</div>
			 		
				</div>
				
				<div class="row fila-customize button-content-pretty " >
					<div class="col-md-12 text-center">
						<button class="btn btn-default " v-on:click="onClickGuardarCompra()">Guardar Compra </button>

					</div>
				</div>
				
				<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token_compra">
				

			</div>
		
		
		
 		</div>



<!-- Modal -->
<div class="modal fade" id="myModalCalcular" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Calcular Precio de Compra</h4>
      </div>
      <div class="modal-body">
        <div>
        	<span style="color: #464646">Para calcular el <b>Precio de Compra</b> de un producto debes proporcionarnos los siguientes datos:</span>
        </div>
        <br>

        <div class="row">
        	<div class="col-md-4" style="padding-right: 5px">
        		<div class="form-group">
	        		<label for="">Cantidad</label>
	        		<input type="number" class="form-control" placeholder="Cantidad del Producto" v-model="calcular.cantidad" v-on:keyup="calcularPrecioCompra()" v-on:change="calcularPrecioCompra()">
	        	</div>
        	</div>
        	<div class="col-md-8" style="padding-left: 5px">
        		<div class="form-group">
	        		<label for="">Monto Venta del Proveedor</label>
	        		<input type="number" step="0.01" class="form-control" placeholder="Monto de Venta del Proveedor" v-model="calcular.monto" v-on:keyup="calcularPrecioCompra()" v-on:change="calcularPrecioCompra()">
	        	</div>
        	</div>
        	
        	
        </div>
		<br>
        <div class="row">
        	<div class="col-md-12 text-center" style="color:#464646">
        		El Precio de Compra calculado es:
        	</div>
        	<div class="col-md-12 text-center">
        		<span style="font-size: 2.5em">S/. @{{ calcular.pCompra }}</span>
        	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sad" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-default" v-on:click="onClickAceptarCalculoPCompra()" data-dismiss="modal">Aceptar</button>
      </div>
    </div>
  </div>
</div>