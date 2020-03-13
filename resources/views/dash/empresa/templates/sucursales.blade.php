<div class="row">
	<div class="col-md-12 border-first_bottom">
		<h3>/ Sucursales - Sedes</h3>
	</div>
	<div class="col-md-12 put-padding-1-top_and_bottom cont" style="height: 500px; overflow-y: auto; box-shadow: rgb(212, 212, 212) 0px 0px 8px 0px inset; background: #eeeeee3b;">
		<div class="row margin-1-bottom">
			<div class="col-md-8">
				<p>
					Lista de Sucursales - Sedes pertenecientes a 
					@if($empresa->nombre_comercial=="")
						<b>{{ $empresa->razon_social }}</b>
					@else
						<b>{{ $empresa->nombre_comercial }}</b>
					@endif
				</p>
			</div>
			<div class="col-md-4 text-right">
				<button class="btn btn-sad btn-sm" v-on:click="onClickNuevaSucursal(9)"><i class="fa fa-plus"></i> Nueva Sucursal - Sede</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-hover" id="table-sucursales">
					<thead>
						<tr>
							<th>N°</th>
							<th>Sucursal/Sede</th>
							<th>Dirección</th>
							<th>Lugar</th>
																
							<th>Creada</th>
							<th >Opciones</th>
						</tr>
					</thead>
					<tbody>
															
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

