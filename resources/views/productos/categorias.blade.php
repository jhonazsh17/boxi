<div class="text-center ventas-title">
			Categorías de Productos
		</div>
		<div class="container-categorias">
			<div class="row-fluid">
				<div class="col-md-6 col">
					<div class="ventas-container-self">
						
		
							<div class="row fila">
								

								<div class="col-md-12 col">
									<div class="form-group">
									    <label>Nombre de Categoría</label>
									    <input type="email" class="form-control input-sm" id="exampleInputEmail1" placeholder="Nombre de Categoría" v-model="categoriaValue">
									    <input type="hidden" name="_token" value="{!! csrf_token() !!}" id="token_categoria">
									</div>
								</div>

								

							</div>

							

						

						
					</div>

					<div class="text-center categoria-value" >
						<div v-if="categoriaValue == '' ">
							<span style="color:#d6d6d6">Nombre de Categoría</span>
						</div>
						<div v-else>
							@{{ categoriaValue }}
						</div>
						
					</div>
					<div class="text-center">
						<button class="btn btn-default btn-sm" v-on:click="guardarCategoria">Guardar Categoria <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
					</div>
					
				</div>
				<div class="col-md-6 col col-container">
					<div class="container-item-categoria">
					
						<table class="table table-condensed table-categorias" >
			 				<thead>
			 					<tr>
			 						<th>N°</th>
			 						<th>Nombre Categoría</th>
			 						<th>Creada</th>
			 						<th>Modificada</th>
			 						<th>Opciones</th>
			 					</tr>
			 				</thead>
			 				<tbody class="categoria-for">

			 					@foreach($categorias as $categoria)
				 					<tr>
				 						<td>{{ $categoria->id }}</td>
				 						<td>{{ $categoria->nombre_categoria }}</td>
				 						<td>{{ $categoria->created_at }}</td>
				 						<td>{{ $categoria->updated_at }}</td>
				 						
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