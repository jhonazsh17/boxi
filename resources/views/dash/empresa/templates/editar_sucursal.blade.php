<div class="row">
    <div class="col-md-12 border-first_bottom" >
        <h3>/ Sucursales - Sedes<small> / @{{dataSucursal.nombre}} / Editar</small></h3>
    </div>
    <div class="col-md-12 put-padding-1-top_and_bottom cont" style="height: 500px; overflow-y: auto; box-shadow: rgb(212, 212, 212) 0px 0px 8px 0px inset; background: #eeeeee3b;">
        <div class="msg-by-empty-input" style="display: none">
        <!-- div para mostrar un mensaje -->
        </div>

		<div class="mensaje-validate-editar"></div>

        <div class="form-group">
			<div class="row">
				<div class="col-md-9" style="padding-right: 7px">
					<label ><span class="color-red">*</span> Nombre Sucursal/Sede:</label>
					<input type="text" class="form-control form-esp form-upper"  placeholder="Ingresar Nombre de Sucursal o sede" v-model="dataSucursal.nombre" >
				</div>
				<div class="col-md-3" style="padding-left: 7px">
					<label >Serie Facturación:</label>
					<input type="text" class="form-control form-esp form-upper"  placeholder="Ingresar Serie" v-model="dataSucursal.serie" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
				</div>
			</div>				    
		</div>
        <div class="form-group">
			<div class="row">
				<div class="col-md-6" style="padding-right: 7px">
					<label ><span class="color-red">*</span> Dirección:</label>
					<input type="text" class="form-control form-esp form-upper"  placeholder="Ingresar Dirección" v-model="dataSucursal.direccion" v-on:keyup="toUpperInForm(dataSucursal.direccion)">
				</div>
				<div class="col-md-6" style="padding-left: 7px">
					<label ><span class="color-red">*</span> Lugar:</label>
					<input type="text" class="form-control form-esp form-upper"  placeholder="Ingresar Lugar" v-model="dataSucursal.lugar" >
				</div>
			</div>
		</div>
        <div class="form-group">
			<label >Descripción:</label> <small style="color:#969696">(<span id="cantDesEdit">0</span> / 280)</small>
			<textarea name="" id=""  rows="3" class="form-control form-esp form-upper" v-model="dataSucursal.descripcion" placeholder="Ingresar Descripción ..." onkeyup="getSizeCharacter(this.value.toUpperCase(), '#cantDesEdit')" maxlength="280"></textarea >
		</div>
		<div class="form-group">
			<button class="btn btn-default" v-on:click="onClickGuardarEditarSucursal()"><i class="fa fa-save">
                </i> Guardar Cambios</button>
			<button class="btn btn-sad margin-m1-left" v-on:click="onClickItem(3)">
                <i class="fa fa-arrow-circle-left">
                </i>
                Cancelar
            </button>
		</div>
		<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token-suc-editar">

    </div>
</div>