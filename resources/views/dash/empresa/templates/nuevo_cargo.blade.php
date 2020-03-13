<div class="row">
	<div class="col-md-12 border-first_bottom" >
		<h3>/ Cargos de Usuarios <small> / Nuevo Cargo</small></h3>
	</div>
	<div class="col-md-12 put-padding-1-top_and_bottom cont" style="height: 500px; overflow-y: auto; box-shadow: rgb(212, 212, 212) 0px 0px 8px 0px inset; background: #eeeeee3b;">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>
	                    <span class="color-red">
	                        *
	                    </span>
	                    Nombre del Cargo:
	                </label>
	                <input class="form-control form-esp form-upper" placeholder="Ingresar Nombre de Cargo" type="text" v-model="dataCargo.nombre">
            	</div>
			</div>
		</div>
		<div class="form-group supr-margin">
            <button class="btn btn-default" v-on:click="onClickGuardarCargo()">
                <i class="fa fa-save">
                </i>
                Guardar
            </button>
            <button class="btn btn-sad margin-m1-left" v-on:click="onClickItem(16)">
                <i class="fa fa-arrow-circle-left">
                </i>
                Cancelar
            </button>
        </div>
        <input id="token-cargo" name="_token" type="hidden" value="{!! csrf_token() !!}"/>
	</div>
</div>