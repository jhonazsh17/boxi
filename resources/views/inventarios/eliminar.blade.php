<div class="text-center ventas-title">
	Eliminar Inventario
</div>

<div style="padding:5px;">
	<div class="row-fluid">
		<div class="col-md-12 text-center suptitle">
			<h4>
				@{{ inventarioAux.tipo }}
			</h4>
		</div>
	</div>

	<div class="row fila-customize form-pretty">
		<div class="col-md-12 col" style="padding-bottom: .5em">
			<div class="row">
				<div class="col-md-12 text-center">
					<h3>¿Estás seguro de eliminar este Inventario?</h3>
				</div>
			</div>
			<div class="row">
				
				<div class="col-md-12">
					<div class="" id="prodInv"></div>
				</div>
			</div>
			
		</div>
		
	</div>
	<div class="row fila-customize button-content-pretty">
		<div class="col-md-12 col text-center">
			<button class="btn btn-sad btn-sm" v-on:click="onClickCancelarEliminarInv()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
			<button class="btn btn-default btn-sm" v-on:click="onClickEliminarDeTodasManeras()"><i class="fa fa-trash"></i> Eliminar de todas maneras</button>
		</div>
	</div>
</div>