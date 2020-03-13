<div class="home-sector-right_menu">
	<ul class="nav nav-pills">
	  <li><a href="#efectuar-compra" id="hacer-compra" v-on:click="mostrarSectorEfectuarCompra()">Efectuar Compra</a></li>
	  <li><a href="#compras" id="ver-compras" v-on:click="mostrarSectorCompras()">Compras</a></li>
	</ul>
</div>

<div class="ventas-container">
	<div v-show="mostrarSectorEfectuarCompraItem">
		

		@include('compras.hacer-compra')
		
 		
	</div>

	<div v-show="mostrarSectorComprasItem">
		
		<div class="text-center ventas-title" >
			<i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 1.2em"></i> &nbsp;&nbsp;Compras
		</div>
		
		<div v-show="tablaCompras==1">
			<div class="ventas-table" style="padding-right: 5px; padding-left: 5px; padding-top: 10px">
				<div style="color:#464646;">
					<div class="row-fluid">
						<div class="col-md-8" style="padding: 0; padding-bottom: 10px">
							Lista de todas las <b>Compras Registradas</b>.
						</div>
						<div class="col-md-4 text-right" style="padding: 0; padding-bottom: 10px">
							<button class="btn btn-sad btn-sm" v-on:click="onClickComprasDelDia()">Compras de Hoy</button>
						</div>
					</div>
					
				</div>
	 			<table class="table table-condensed table-compras" >
	 				<thead>
	 					<tr>
	 						<th></th>
	 						<th>N°</th>
	 						<th>Fecha y Hora - Compra</th>
	 						<th>Documento</th>
	 						<th>Proveedor</th>
	 						<th>Productos</th>
	 						<th>Monto (S/.)</th>
	 						<th>Fecha y Hora - Modificación</th>
	 						
	 						<th>Opciones</th>
	 					</tr>
	 				</thead>
	 				
	 			</table>
 			</div>
 		</div>

 		<div v-show="tablaCompras==3">
 			
			<div class="ventas-table" style="padding-right: 5px; padding-left: 5px; padding-top: 10px">
				<div style="color:#464646;">
					<div class="row-fluid">
						<div class="col-md-8" style="padding: 0; padding-bottom: 10px">
							Lista de Todas las <b>Compras de Hoy : <span style="text-decoration: underline"><?php echo date('d-m-Y'); ?></span></b>.
						</div>
						<div class="col-md-4 text-right" style="padding: 0; padding-bottom: 10px">
							<button class="btn btn-sad btn-sm" v-on:click="volverSectorCompras()"><i class="fa fa-arrow-circle-left"></i> Volver a Compras </button>
						</div>
					</div>
					
				</div>
	 			<table class="table table-condensed table-compras-hoy" >
	 				<thead>
	 					<tr>
	 						<th></th>
	 						<th>N°</th>
	 						<th>Fecha y Hora - Compra</th>
	 						<th>Documento</th>
	 						<th>Proveedor</th>
	 						<th>Productos</th>
	 						<th>Monto (S/.)</th>
	 						<th>Fecha y Hora - Modificación</th>
	 						
	 						<th>Opciones</th>
	 					</tr>
	 				</thead>
	 				
	 			</table>
 			</div>
 		</div>
		
	</div>
</div>