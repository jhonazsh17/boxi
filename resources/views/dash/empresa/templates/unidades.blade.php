<div class="row">
	<div class="col-md-12 border-first_bottom">
		<h3>/ Unidades de Medida</h3>
	</div>
	<div class="col-md-12 put-padding-1-top_and_bottom cont" style="height: 500px; overflow-y: auto; box-shadow: rgb(212, 212, 212) 0px 0px 8px 0px inset; background: #eeeeee3b;">
		<div class="row" style="margin-bottom: .7em">
			<div class="col-md-8">
				Lista de Unidades de Medida registradas en 
				@if($empresa->nombre_comercial=="")
					<b>{{ $empresa->razon_social }}</b>
				@else
					<b>{{ $empresa->nombre_comercial }}</b>
				@endif
			</div>
			<div class="col-md-4 text-right">
				<button class="btn btn-sad btn-sm" v-on:click="onClickNuevaUnidad()"><i class="fa fa-plus"></i> Nueva Unidad de Medida</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-hover table-striped" id="table-unidades">
					<thead>
						<tr>
							<th>N°</th>
							<th>Unidad de Medida</th>
							<th>Abreviatura</th>
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

