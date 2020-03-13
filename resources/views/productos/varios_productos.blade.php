<tr v-for="(producto, i) in productosVarios">
	<td>
		<div v-if="seleccionarActivate==true">
			<input type="checkbox" class="checky" v-on:click="clickCheck('#eliminar-varios')">
		</div>
		
	</td>
	<td class="text-small">@{{ i+1 }}</td>
	<td class="text-small">@{{ producto.codigo }}</td>
	<td class="text-small">@{{ producto.producto }}</td>
	<td class="text-small">@{{ producto.nombre_comercial }}</td>
	<td class="text-small">@{{ producto.categoria }}</td>
	<td class="text-small">@{{ producto.cantidad }} @{{ producto.unidad }}</td>
	<td class="text-small">@{{ producto.pUnitario }}</td>
	<td>
		<button class="btn btn-default btn-xs">
 			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
 		</button>
		<button class="btn btn-sad btn-xs">
 			<i class="fa fa-trash" aria-hidden="true"></i>
 		</button>
 		
	</td>
</tr>