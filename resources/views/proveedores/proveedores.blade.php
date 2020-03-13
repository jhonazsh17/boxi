<div class="home-sector-right_menu">
	<ul class="nav nav-pills">
	  <li><a href="#proveedores" v-on:click="mostrarSectorProveedores()">Proveedores</a></li>
	</ul>
</div>

<div class="ventas-container">
	<div v-show="mostrarSectorProveedoresItem">
		<div class="text-center ventas-title">
			Lista Proveedores
		</div>
		<div class="row-fluid">
			<div class="ventas-table" style="padding-right: 5px; padding-left: 5px; padding-top: 10px" >
				<table class="table table-condensed table-ventas" id="table-proveedores" >
		 				<thead>
		 					<tr>
		 						<th></th>
		 						<th>N°</th>
		 						<th>Proveedor</th>
		 						<th>DNI</th>
		 						<th>RUC</th>
		 						<th>Fecha Creación</th>
		 						<th>Fecha Actualización</th>
		 						<th>Opciones</th>
		 					</tr>
		 				</thead>
		 				
		 			</table>
			</div>
		</div>
	</div>
	
</div>