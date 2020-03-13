<div class="row">
	<div class="col-md-12 border-first_bottom">
		<h3>/ Información</h3>
	</div>
	<div class="col-md-12 put-padding-1-top_and_bottom cont" style="height: 500px; overflow-y: auto; box-shadow: rgb(212, 212, 212) 0px 0px 8px 0px inset; background: #eeeeee3b;">
		<div class="row">
			<div class="col-md-9" style="padding-right: .7em">
				<h4><b>Nombre / Razón Social:</b> {{ $empresa->razon_social }}</h4>
				<hr style="border-color: #ccc">
				<h5><b>Nombre Comercial:</b> {{ $empresa->nombre_comercial }}</h5>
				<h5><b>RUC:</b> {{ $empresa->ruc }}</h5>
				<h5><b>Dirección:</b> {{ $empresa->direccion }}</h5>
				<h5><b>Distrito:</b> {{ $empresa->distrito }}</h5>
				<h5><b>Provincia:</b> {{ $empresa->provincia }}</h5>
				<h5><b>Departamento:</b> {{ $empresa->departamento }}</h5>
				<h5><b>País:</b> {{ $empresa->pais }}</h5>
				<hr style="border-color: #ccc">

				<h5 ><b>Descripción:</b></h5>
				@if($empresa->descripcion=="")
				<p style="color: #bbb;">Aún no definida.</p>
				@else
				<p>{{ $empresa->descripcion }}</p>
				@endif

				<h5><b>Misión:</b></h5>
				@if($empresa->mision=="")
				<p style="color: #bbb;">Aún no definida.</p>
				@else
				<p>{{ $empresa->mision }}</p>
				@endif

				<h5><b>Visión:</b></h5>
				@if($empresa->vision=="")
				<p style="color: #bbb;">Aún no definida.</p>
				@else
				<p>{{ $empresa->vision }}</p>
				@endif
			
				<hr style="border-color: #ccc">

				<h5 ><b>Creada en BOXI el:</b> {{ $empresa->created_at }}</h5>
				<hr style="border-color: #ccc">
													
				<button class="btn btn-sad " v-on:click="onClickEditarInformacion()">
					Editar Información
				</button>
			</div>
			<div class="col-md-3" style="padding-left: .7em">
				@if($empresa->logo=="")
					<img src="{{ asset('img') }}/logo-default.png" alt="" width="100%" style="border: 3px solid #ccc; border-radius: 5px">
				@else
					<img src="{{ asset('uploads/empresas/logo') }}/{{ $empresa->logo }}" alt="" width="100%" style="border: 3px solid #ccc; border-radius: 5px">
				@endif

				<div class="text-center">
					<button class="btn btn-sad btn-sm btn-block" style="margin-top: 1em"><i class="fa fa-edit"></i> Cambiar Logo</button>
					{{-- <button class="btn btn-sad btn-sm " style="margin-top: 1em">Quitar Logo</button> --}}
				</div>							
			</div>
		</div>
	</div>
	
	
</div>