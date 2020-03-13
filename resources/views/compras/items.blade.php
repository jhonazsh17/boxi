<tr v-for="(producto, i) in itemsCompra">
	<td>
		<div v-if="seleccionarActivate==true">
			<input type="checkbox" class="checky" {{-- v-on:click="clickCheck()" --}}>
		</div>
		
	</td>
	
	<td >@{{ producto.cantidad }}</td>
	<td >@{{ producto.producto }}</td>
	<td >@{{ producto.pCompra }}</td>
	<td >@{{ producto.monto }}</td>
	
	<td>
		<button class="btn btn-default btn-xs">
 			<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
 		</button>
		<button class="btn btn-sad btn-xs">
 			<i class="fa fa-trash" aria-hidden="true"></i>
 		</button>
 		
	</td>
</tr>