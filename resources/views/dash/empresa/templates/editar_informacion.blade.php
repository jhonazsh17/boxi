<div class="row">
	<div class="col-md-12 border-first_bottom" >
		<h3>/ Información <small>/ Editar Información</small></h3>
	</div>
	<div class="col-md-12 put-padding-1-top_and_bottom cont" style="height: 500px; overflow-y: auto; box-shadow: rgb(212, 212, 212) 0px 0px 8px 0px inset; background: #eeeeee3b;">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label ><span class="color-red">*</span> Nombre/Razón Social:</label>
					<input type="text" class="form-control form-esp"  placeholder="Nombre/Razón Social" value="{{ $empresa->razon_social }}" id="rs" v-on:keyup="onKey()">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4" style="padding-right: 7px">
				<div class="form-group">
					<label ><span class="color-red">*</span> RUC:</label>
					<input type="text" class="form-control form-esp"  placeholder="RUC" value="{{ $empresa->ruc }}" id="ruc" v-on:keyup="onKey()">
				</div>
			</div>
			<div class="col-md-8" style="padding-left: 7px">
				<div class="form-group">
					<label >Nombre Comercial:</label>
					<input type="text" class="form-control form-esp"  placeholder="Nombre Comercial" value="{{ $empresa->nombre_comercial }}" id="nc" v-on:keyup="onKey()">
				</div>
			</div>
		</div>
		<!-- evalua template que pertenece a formularios de pais /region/provincia/distrito -->
		<div v-if="activeDir==true">
			<div class="row">
				<div class="col-md-1" style="padding-right: 7px; padding-top: 1.8em">
					<button class="btn btn-sad btn-md btn-block" v-on:click="onClickActivarEditDireccion()"><i class="fa fa-check"></i></button>
				</div>
				<div class="col-md-3" style="padding-right: 7px; padding-left: 7px">
					<div class="form-group">
						<label ><span class="color-red">*</span> País:</label>
						<input type="text" class="form-control form-esp" value="{{ $empresa->pais }}" disabled  id="pa">
					</div>
				</div>
				<div class="col-md-3" style="padding-right: 7px; padding-left: 7px">
					<div class="form-group">
						<label ><span class="color-red">*</span> Departamento:</label>
						<input type="text" class="form-control form-esp" value="{{ $empresa->departamento }}" disabled id="de"> 
					</div>
				</div>
				<div class="col-md-2" style="padding-right: 7px; padding-left: 7px">
					<div class="form-group">
						<label ><span class="color-red">*</span> Provincia:</label>
						<input type="text" class="form-control form-esp" value="{{ $empresa->provincia }}" disabled id="pr">
					</div>
				</div>
				<div class="col-md-3" style="padding-left: 7px">
					<div class="form-group">
						<label ><span class="color-red">*</span> Distrito:</label>
						<input type="text" class="form-control form-esp" value="{{ $empresa->distrito }}" disabled id="di">
					</div>
				</div>	
				<div class="col-md-12">
					<div class="form-group">
						<label ><span class="color-red">*</span> Dirección:</label>
						<input type="text" class="form-control form-esp"  placeholder="Dirección" value="{{ $empresa->direccion }}" disabled id="dir" >
					</div>
				</div>
			</div>	
		</div>
		<div v-else>
			<div class="row">
				<div class="col-md-1" style="padding-right: 7px;padding-top: 1.8em">
					<button class="btn btn-sad btn-md btn-block" v-on:click="onClickDesactivarEditDireccion()"><i class="fa fa-times"></i></button>
				</div>
				<div class="col-md-3" style="padding-right: 7px; padding-left: 7px">
					<div class="form-group">
						<label ><span class="color-red">*</span> País:</label>
						<select name="" id="" class="form-control form-esp">
							<option value="Perú">Perú</option>
						</select>
					</div>
				</div>
				<div class="col-md-3" style="padding-right: 7px; padding-left: 7px">
					<div class="form-group">
						<label ><span class="color-red">*</span> Departamento:</label>
						<select name="" id="" class="form-control form-esp" v-model="lugar.departamento" v-on:change="onChangeDepartamento()">
							<option value="" selected disabled>Elegir</option>
							<option v-for="departamento in ubigeo.departamentos" v-bind:value="departamento.id_ubigeo"  >@{{ departamento.nombre_ubigeo }}</option>
						</select> 
					</div>
				</div>
				<div class="col-md-2" style="padding-right: 7px; padding-left: 7px">
					<div class="form-group">
						<label ><span class="color-red">*</span> Provincia:</label>
						<select name="" id="" class="form-control form-esp" v-model="lugar.provincia" v-on:change="onChangeProvincia()">
							<option value="" selected disabled>Elegir</option>
							<option v-for="provincia in ubigeo.provincias" v-bind:value="provincia.id_ubigeo"  >@{{ provincia.nombre_ubigeo }}</option>
						</select> 
					</div>
				</div>
				<div class="col-md-3" style="padding-left: 7px">
					<div class="form-group">
						<label ><span class="color-red">*</span> Distrito:</label>
						<select name="" id="" class="form-control form-esp" v-model="lugar.distrito" v-on:change="onChangeDistrito()">
							<option value="" selected disabled>Elegir</option>
							<option v-for="distrito in ubigeo.distritos" v-bind:value="distrito.id_ubigeo"  >@{{ distrito.nombre_ubigeo }}</option>
						</select> 
					</div>
				</div>	
				<div class="col-md-12">
					<div class="form-group">
						<label ><span class="color-red">*</span> Dirección:</label>
						<input type="text" class="form-control form-esp"  placeholder="Dirección" value="{{ $empresa->direccion }}" v-on:keyup="onKey()">
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label >Descripción:</label>
					<textarea name="" rows="3" class="form-control form-esp" placeholder="Descripción" id="des" v-on:keyup="onKey()">{{ $empresa->descripcion }}</textarea>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6" style="padding-right: 7px">
				<div class="form-group">
					<label >Visión:</label>
					<textarea name=""  rows="3" class="form-control form-esp" placeholder="Visión" id="vi" v-on:keyup="onKey()">{{ $empresa->vision }}</textarea>
				</div>
			</div>
			<div class="col-md-6" style="padding-left: 7px">
				<div class="form-group">
					<label >Misión:</label>
					<textarea name=""  rows="3" class="form-control form-esp" placeholder="Misión" id="mi" v-on:keyup="onKey()">{{ $empresa->mision }}</textarea>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token_empresa">
				<button class="btn btn-default " v-on:click="onClickGuardarEditarInformacion()"><i class="fa fa-save"></i>&nbsp; Guardar Cambios</button>

				<button class="btn btn-sad margin-m1-left" v-on:click="onClickItem(1)"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
			</div>
		</div>

	</div>
</div>
									<!-- <div class="row" style="margin-bottom: .7em">
										<div class="col-md-6">
											<h4><b>Editar Información de Empresa.</b></h4>
										</div>
										<div class="col-md-6 text-right">
											<button class="btn btn-sad btn-sm" v-on:click="onClickItem(1)"><i class="fa fa-arrow-circle-left"></i> Volver</button>
										</div>
									</div> -->

									
									
									

									
										
									
										

									

									
										
									