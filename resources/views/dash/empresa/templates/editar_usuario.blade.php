<div class="row">
	<div class="col-md-12 border-first_bottom" >
		<h3>/ Usuarios Empleados<small> / @{{dataUsuarioEmpleado.nombre}} / Editar</small></h3>
	</div>
	<div class="col-md-12 put-padding-1-top_and_bottom cont" style="height: 500px; overflow-y: auto; box-shadow: rgb(212, 212, 212) 0px 0px 8px 0px inset; background: #eeeeee3b;">
		<!-- se muestra este div si no hay cargos creados -->
		
			<div class="row">
				<div class="col-md-6" style="padding-right: 7px">
					<div class="form-group">
						<label>
		                    <span class="color-red">
		                        *
		                    </span>
		                    Nombre de Usuario:
		                </label>
		                <input class="form-control form-esp form-upper" placeholder="Ingresar Nombre de Usuario" type="text" v-model="dataUsuarioEmpleado.nombre">
	            	</div>
				</div>
				<div class="col-md-3" style="padding-right: 7px; padding-left: 7px">
					<div class="form-group">
						<label>
		                    <span class="color-red">
		                        *
		                    </span>
		                    Tipo de Documento:
		                </label>
		                <select name="" id="" class="form-control form-esp form-upper" v-model="dataUsuarioEmpleado.tipo_documento">
		                	<option value="" disabled selected>Elegir Tipo de Documento</option>
		                	<option v-for="tipo in tipo_doc" v-bind:value="tipo.value">@{{tipo.option}}</option>
		                </select>
		                <!-- <input class="form-control form-esp form-upper" placeholder="Ingresar DNI" type="text"> -->
	            	</div>
				</div>
				<div class="col-md-3" style="padding-left: 7px;">
					<div class="form-group">
						<label>
		                    <span class="color-red">
		                        *
		                    </span>
		                    N° de Documento:
		                </label>
		                <input class="form-control form-esp form-upper" placeholder="Ingresar N° Documento" type="number" v-model="dataUsuarioEmpleado.nro_documento">
	            	</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-2" style="padding-right: 7px">
					<div class="form-group">
						<label>
		                    <span class="color-red">
		                        *
		                    </span>
		                    Genero:
		                </label>
		                <select name="" id="" class="form-control form-esp form-upper" v-model="dataUsuarioEmpleado.genero">
		                	<option value="" disabled selected>Elegir Genero</option>
		                	<option v-for="gen in genero" v-bind:value="gen.value">@{{gen.option}}</option>
		                </select>
	            	</div>
				</div>
				<div class="col-md-6" style="padding-left: 7px; padding-right: 7px">
					<div class="form-group">
						<label>
		                    <span class="color-red">
		                        *
		                    </span>
		                    Dirección:
		                </label>
		                <input class="form-control form-esp form-upper" placeholder="Ingresar Dirección" type="text" v-model="dataUsuarioEmpleado.direccion">
	            	</div>
				</div>
				<div class="col-md-4" style="padding-left: 7px">
					<div class="form-group">
						<label>
		                    <span class="color-red">
		                        *
		                    </span>
		                    Sucursal:
		                </label>
		                <select class="form-control form-esp form-upper" v-model="dataUsuarioEmpleado.sucursal_name">
		                	<option value="" disabled>Elegir Sucursal</option>
		                	<option v-for="sucursal in sucursalesReceive" v-bind:value="sucursal.id">@{{sucursal.nombre_sucursal}}</option>
		                </select>
		                

	            	</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4" style="padding-right: 7px">
					<div class="form-group">
						<label>
		                    <span class="color-red">
		                        *
		                    </span>
		                    Cargo de Usuario:
		                </label>
		                <select class="form-control form-esp form-upper" v-model="dataUsuarioEmpleado.cargo_name">
		                	<option value="" disabled>Elegir Cargo</option>
		                	
		                	<option v-for="cargo in cargosReceive" v-bind:value="cargo.id">@{{cargo.nombre}}</option>
		                </select>
		                <!-- <input class="form-control form-esp form-upper" placeholder="Ingresar DNI" type="text"> -->
	            	</div>
				</div>
				<div class="col-md-4" style="padding-right: 7px; padding-left: 7px">
					<div class="form-group">
						<label>
		                    <span class="color-red">
		                        *
		                    </span>
		                    Correo Electrónico:
		                </label>
		                <input class="form-control form-esp form-upper" placeholder="Ingresar Correo Electrónico" type="email" v-model="dataUsuarioEmpleado.email">
	            	</div>
				</div>
				<div class="col-md-4" style="padding-left: 7px;">
					<div class="form-group">
						<label>
		                    <span class="color-red">
		                        *
		                    </span>
		                    Contraseña:
		                </label>
		                <input class="form-control form-esp form-upper" placeholder="Ingresar Contraseña" type="password" v-model="dataUsuarioEmpleado.password" disabled>
	            	</div>
				</div>
				
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token_employed">
					<button class="btn btn-default " v-on:click="onClickGuardarNuevoUsuario()"><i class="fa fa-save"></i>&nbsp; Guardar Cambios</button>

					<button class="btn btn-sad margin-m1-left" v-on:click="onClickItem(2)"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
				</div>
			</div>
		</div>
		
	
</div>