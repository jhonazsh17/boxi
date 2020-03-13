<div class="ventas-container" >
	<div  >
		<div class="text-center ventas-title">
			Panel Principal
		</div>
		<div class="panel-principal">
			{{-- <div class="row-fluid fila-principal">
				<div class="col-md-2 col">
					fghfg
				</div>
				<div class="col-md-2 col">
					re
				</div>
				<div class="col-md-2 col">
					erewrwe
				</div>
				<div class="col-md-2 col">
					23423
				</div>
				<div class="col-md-2 col">
					dfgsdfg
				</div>
				<div class="col-md-2 col">
					dgd fgsdg
				</div>
			</div> --}}
			<div class="row-fluid " >
				<div class="col-md-3" style="padding:5px 0px 5px 5px;">
					<div class="panel-item" style="border:0;border-top: 1px solid #d6d6d6">
						<div class="panel-item-head text-center">
							<b style="color:#464646">Ventas del Día | <?php echo date('d-m-Y'); ?></b>
						</div>
						<div class="panel-item-body">
							<div v-if="ventasHoyPanelLogic===false">
								<div class="panel-item-actividad text-center" style="padding-top: 3.15em; padding-bottom: 3.2em" >
									Calculando...
								</div>
							</div>
							<template v-else>
								<div class="panel-item-actividad text-center"  >
									<span style="font-size: 3em; color: #464646">S/. @{{ventasHoyPanel}}</span>&nbsp;
									<span style="color:#464646">Soles</span><br>
									<a class="btn btn-link btn-sm" href="#" v-on:click="onClickVentasDelDiaPanel()">Ver Ventas</a>
								</div> 
							</template>
							
							
						</div>
					</div>
				</div>
				<div class="col-md-3" style="padding:5px 0px 5px 5px;">
					<div class="panel-item" style="border:0;border-top: 1px solid #d6d6d6">
						<div class="panel-item-head text-center">
							<b style="color:#464646">Ventas del Mes | <?php echo date('m-Y'); ?></b>
						</div>
						
						<div class="panel-item-body">
							<div v-if="ventasMesPanelLogic===false">
								<div class="panel-item-actividad text-center" style="padding-top: 3.15em; padding-bottom: 3.2em" >
									Calculando...
								</div>
							</div>
							<template v-else>
								<div class="panel-item-actividad text-center"  >
									<span style="font-size: 3em; color: #464646">S/. @{{ventasMesPanel}}</span>&nbsp;
									<span style="color:#464646">Soles</span><br>
									<a class="btn btn-link btn-sm" href="">Ver Ventas</a>
								</div> 
							</template>
							
						</div>
					</div>
				</div>
				<div class="col-md-3" style="padding:5px 0px 5px 5px;">
					<div class="panel-item" style="border:0;border-top: 1px solid #d6d6d6">
						<div class="panel-item-head text-center">
							<b style="color:#464646">Compras del Día | <?php echo date('d-m-Y'); ?></b>
						</div>
						<div class="panel-item-body">
							<div v-if="comprasHoyPanelLogic===false">
								<div class="panel-item-actividad text-center" style="padding-top: 3.15em; padding-bottom: 3.2em" >
									Calculando...
								</div>
							</div>
							<template v-else>
								<div class="panel-item-actividad text-center">
									<span style="font-size: 3em; color: #464646">S/. @{{comprasHoyPanel}}</span>&nbsp;
									<span style="color:#464646">Soles</span><br>
									<a class="btn btn-link btn-sm" href="">Ver Compras</a>
								</div> 
							</template>
							

							
						</div>
					</div>
				</div>
				<div class="col-md-3" style="padding:5px 5px 5px 5px;">
					<div class="panel-item" style="border:0;border-top: 1px solid #d6d6d6">
						<div class="panel-item-head text-center">
							<b style="color:#464646">Compras del Mes | <?php echo date('m-Y'); ?></b>
						</div>
						<div class="panel-item-body">
							<div v-if="comprasMesPanelLogic===false">
								<div class="panel-item-actividad text-center" style="padding-top: 3.15em; padding-bottom: 3.2em" >
									Calculando...
								</div>
							</div>
							<template v-else>
								<div class="panel-item-actividad text-center">
									<span style="font-size: 3em; color: #464646">S/. @{{comprasMesPanel}}</span>&nbsp;
									<span style="color:#464646">Soles</span><br>
									<a class="btn btn-link btn-sm" href="">Ver Compras</a>
								</div> 
							</template>
						</div>
					</div>
				</div>
				{{-- <div class="col-md-3 col" style="padding:5px 0px 5px 5px;">
					<div class="panel-item" style="border:0;border-top: 1px solid #d6d6d6">
						<div class="panel-item-head text-center">
							<b>Actividades Recientes &nbsp;&nbsp;<i class="fa fa-tasks" aria-hidden="true"></i></b>
						</div>
						<div class="panel-item-body">
							<div class="panel-item-actividad">
								El Vendedor <b>Jhon Medina</b>, ha hecho una venta rápida de 7 items.
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col" style="padding:5px 3px 5px 5px;">
					<div class="panel-item" style="border:0;border-top: 1px solid #d6d6d6">
						<div class="panel-item-head text-center">
							<b>Actividades Recientes &nbsp;&nbsp;<i class="fa fa-tasks" aria-hidden="true"></i></b>
						</div>
						<div class="panel-item-body">
							<div class="panel-item-actividad">
								El Vendedor <b>Jhon Medina</b>, ha hecho una venta rápida de 7 items.
							</div>
						</div>
					</div>
				</div> --}}
			</div>
			<div class="row-fluid ">
				{{-- <div class="col-md-3 col" style="padding:5px 0px 5px 5px;">
					
					<div class="panel-item" style="border:0;border-top: 1px solid #d6d6d6">
						<div class="panel-item-head text-center">
							<b>Actividades Recientes &nbsp;&nbsp;<i class="fa fa-tasks" aria-hidden="true"></i></b>
						</div>
						<div class="panel-item-body">
							<div class="panel-item-actividad">
								El Vendedor <b>Jhon Medina</b>, ha hecho una venta rápida de 7 items.
							</div>
							<div class="panel-item-actividad">
								El Vendedor <b>Tefy</b>, ha modificado la venta N° 00034.
							</div>
							<div class="panel-item-actividad">
								<b>Tú</b>, has efectuado una compra de 3 items al proveedor ALICORP.
							</div>
							<div class="panel-item-actividad">
								El Vendedor <b>Tefy</b>, ha hecho una venta de 3 items al Cliente Enrique Iglesias.
							</div>
							<div class="panel-item-actividad">
								El Vendedor <b>Jhon Medina</b>, ha hecho una venta rápida de 7 items.
							</div>
							<div class="panel-item-actividad">
								El Vendedor <b>Tefy</b>, ha modificado la venta N° 00034.
							</div>
							<div class="panel-item-actividad">
								<b>Tú</b>, has efectuado una compra de 3 items al proveedor ALICORP.
							</div>
							<div class="panel-item-actividad">
								El Vendedor <b>Tefy</b>, ha hecho una venta de 3 items al Cliente Enrique Iglesias.
							</div>
							<div class="panel-item-actividad">
								<b>Tú</b>, has efectuado una compra de 3 items al proveedor ALICORP.
							</div>
							<div class="panel-item-actividad">
								El Vendedor <b>Tefy</b>, ha hecho una venta de 3 items al Cliente Enrique Iglesias.
							</div>
						</div>
						
					</div>
				</div> --}}

				
			</div>
			
		</div>
	</div>
</div>