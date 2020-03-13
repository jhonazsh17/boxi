<div class="text-center ventas-title">
			Unidades de Medida
		</div>
		<div class="container-categorias">
			<div class="row-fluid">
				<div class="col-md-6 col">
					<div class="ventas-container-self">
						
		
							<div class="row fila">
								

								<div class="col-md-10 col">
									<div class="form-group">
									    <label>Unidad de Medida</label>
									    <input type="email" class="form-control input-sm" id="exampleInputEmail1" placeholder="Unidad de Medida" v-model="unidadValue">
									    
									</div>
								</div>
								<div class="col-md-2 col">
									<div class="form-group">
									    <label>Und. Abrev.</label>
									    <input type="email" class="form-control input-sm" id="exampleInputEmail1" placeholder="Und. Abrev." v-model="unidadAbrevValue">
									    <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token_unidad">
									</div>
								</div>

								

							</div>

							

						

						
					</div>

					<div class="text-center categoria-value" >
						<div v-if="unidadValue == '' ">
							<span style="color:#d6d6d6">Unidad de Medida - Abreviatura</span>
						</div>
						<div v-else>
							@{{ unidadValue }} - 
							<span v-if="unidadAbrevValue == '' " style="color:#d6d6d6"> Abreviatura</span>
							<span v-else>@{{ unidadAbrevValue }}</span>
							
						</div>
						
					</div>
					<div class="text-center">
						<button class="btn btn-default btn-sm" v-on:click="guardarUnidad">Guardar Unidad de Medida <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
					</div>
					
				</div>
				<div class="col-md-6 col col-container">
					<div class="container-item-categoria">
					
						<table class="table table-condensed table-unidades" >
			 				<thead>
			 					<tr>
			 						<th>N°</th>
			 						<th>Unidad</th>
			 						<th>Abreviatura</th>
			 						<th>Creada</th>
			 						<th>Modificada</th>
			 						<th>Opciones</th>
			 					</tr>
			 				</thead>
			 				<tbody class="unidad-for">

			 					@foreach($unidades as $unidad)
				 					<tr>
				 						<td>{{ $unidad->id }}</td>
				 						<td>{{ $unidad->unidad }}</td>
				 						<td>{{ $unidad->abreviatura }}</td>
				 						<td>{{ $unidad->created_at }}</td>
				 						<td>{{ $unidad->updated_at }}</td>
				 						
				 						<td>
				 							<button class="btn btn-default btn-xs">
				 								<i class="fa fa-trash" aria-hidden="true"></i>
				 							</button>
				 							<button class="btn btn-default btn-xs">
				 								<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
				 							</button>
				 						</td>
				 					</tr>
			 					@endforeach
			 					
			 				</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>