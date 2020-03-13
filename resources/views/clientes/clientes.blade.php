<div class="home-sector-right_menu">
	<ul class="nav nav-pills">
	  <li><a href="#clientes" v-on:click="mostrarSectorClientes()">Clientes</a></li>
	</ul>
</div>

<div class="ventas-container">
	<div v-show="mostrarSectorClientesItem">
		<div class="text-center ventas-title">
			Lista Clientes
		</div>
		<div class="row-fluid">
			<div class="ventas-table" style="padding-right: 5px; padding-left: 5px; padding-top: 10px" >
				<table class="table table-condensed table-ventas" id="table-clientes" >
		 				<thead>
		 					<tr>
		 						<th></th>
		 						<th>N°</th>
		 						<th>Cliente</th>
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