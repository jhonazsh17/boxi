<div class="row">
	<div class="col-md-12 border-first_bottom" >
		<h3>/ Cargos de Usuarios</h3>
	</div>
	<div class="col-md-12 put-padding-1-top_and_bottom cont" style="height: 500px; overflow-y: auto; box-shadow: rgb(212, 212, 212) 0px 0px 8px 0px inset; background: #eeeeee3b;">
		<div class="row margin-1-bottom">
			<div class="col-md-8">
				<p>
					Lista de Cargos para Usuarios Empleados pertenecientes a 
					@if($empresa->nombre_comercial=="")
						<b>{{ $empresa->razon_social }}</b>
					@else
						<b>{{ $empresa->nombre_comercial }}</b>
					@endif
				</p>
			</div>
			<div class="col-md-4 text-right">
				<button class="btn btn-sad btn-sm" v-on:click="onClickNuevoCargo()"><i class="fa fa-plus"></i> Nuevo Cargo</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-hover table-striped" id="table-cargos">
					<thead>
						<tr>
							<th>N°</th>
							<th>Cargos</th>
							<th>Creado</th>
							<th style="width: 250px">Opciones</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>