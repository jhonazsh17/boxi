<div class="home-sector-right_menu">
	<ul class="nav nav-pills">
	  <li><a href="#" v-on:click="mostrarSectorAlmacen" >Almacén</a></li>
	  <li><a href="#" v-on:click="mostrarSectorStockProducto" >Movimientos</a></li>
	  {{-- <li><a href="#" v-on:click="" >Kardex de Productos</a></li> --}}
	</ul>
</div>

<div class="ventas-container">
	<div v-show="mostrarSectorAlmacenItem">
		<div class="text-center ventas-title">
			Almacén
		</div>
		<div class="row-fluid">

		
			<div class="ventas-table" style="padding-right: 5px; padding-left: 5px; padding-top: 5px" >
				<div  style="margin-bottom: 10px">
					<div >
						<h4 ><i class="fa fa-square" style="color:#e67e22"></i>&nbsp;&nbsp;<b>{{ $almacen->nombre }}</b></h4>	
						<p style="color:#464646">
							Lista de Productos en almacén con su respectivo stock actual.
						</p>	
					</div>
				</div>
				
				<table class="table table-condensed table-hover table-striped" id="table-almacen">
					<thead>
						<tr>
							<th></th>
							<th>N°</th>
							<th>Código</th>
							<th>Producto</th>
							<th>Presentación</th>
							<th>Nombre Comercial</th>
							<th>Categoria</th>
							<th>Stock</th>
							
							<th >Opciones</th>
						</tr>
					</thead>
					
				</table>
			</div>
		</div>
	</div>

	<div v-show="mostrarSectorStockProductoItem">
		<div class="text-center ventas-title">
			Almacén
		</div>
		<div class="row-fluid">

		
			<div class="ventas-table" style="padding-right: 5px; padding-left: 5px; padding-top: 5px" >
				<div  style="margin-bottom: 10px">
					<div >
						<h4 ><i class="fa fa-square" style="color:#e67e22"></i>&nbsp;&nbsp;<b>{{ $almacen->nombre }}</b></h4>	
						<p>
							Movimientos del Almacén.
						</p>	
					</div>
				</div>


				<table class="table table-condensed table-hover table-striped" id="table-kardex" >
					<thead>
						<tr>
							<th></th>
							<th>N°</th>
							<th>Id Op.</th>
							<th>Fecha</th>
							<th>Detalle</th>
							<th>Entidad</th>
							<th>Producto</th>
							<th>Saldo</th>
							<th>Entrada</th>
							<th>Salida</th>
							<th>Stock</th>
							
							<th>Opciones</th>
						</tr>
						
					</thead>
					
				</table>




			</div>
		</div>
	</div>

</div>