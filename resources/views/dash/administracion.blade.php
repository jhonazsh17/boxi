@extends('base-other')

@section('contenedor')
<div >
	<br>
	<div class="container">
		<div class="row">
			
			<div class="col-md-12" style="padding-left: 5px">
				<div class="panel-boxi">
					<div class="panel-boxi_head" style="font-size: 1.2em">
						<b>Administración</b>
					</div>
					<div class="panel-boxi_body">
						<div class="row">
							<div class="col-md-6">
								<p>Lista de Empresas que son Administradas por esta cuenta.</p>
							</div>
							<div class="col-md-6 text-right" style="margin-bottom: 10px">
								<a class="btn btn-sad btn-sm" href="{{ url('empresa/crear') }}">
									<i class="fa fa-plus"></i> Crear Nueva Empresa
								</a>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">

							<table class="table table-condensed table-hover" id="table-empresas">
								<thead>
									<tr>
										<th>N°</th>
										<th>RUC</th>
										<th>Razón social</th>
										<th>Nombre Comercial</th>
										<th>Creada</th>
										<th style="width: 250px">Opciones</th>
									</tr>
								</thead>
								<tbody>
									<?php $i=0; ?>
									@foreach($empresas as $empresa)
									<tr>
										<td style="vertical-align: middle;">{{ $i=$i+1 }}</td>
										<td style="vertical-align: middle;"><a href="{{ url('') }}/{{ $empresa->slug }}/dash">{{ $empresa->ruc }}</a></td>
										<td style="vertical-align: middle;"><a href="{{ url('') }}/{{ $empresa->slug }}/dash">{{ $empresa->razon_social }}</a></td>
										<td style="vertical-align: middle;"><a href="{{ url('') }}/{{ $empresa->slug }}/dash">{{ $empresa->nombre_comercial }}</a></td>
										<td style="vertical-align: middle;">{{ $empresa->created_at }}</td>
										<td style="vertical-align: middle;">
											<a class="btn btn-default btn-xs" href="{{ url('') }}/{{ $empresa->slug }}/dash">
												<i class="fa fa-arrow-circle-up"></i> Administrar</a>
											<a class="btn btn-sad btn-xs" href="{{ url('') }}/{{ $empresa->slug }}/configuracion"><i class="fa fa-cogs"></i> Configuración</a>
										</td>
									</tr>
									@endforeach
									
								</tbody>
							</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	
	
@endsection

@section('scripts')
<script>
				$('#table-empresas').DataTable({
                    
                    "order": [[ 4, "desc" ]],
                    "pageLength": 10, 
                    "language":{
                        "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                        "lengthMenu":"Mostrar _MENU_ Empresas",
                        "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Empresas",
                        "paginate": {
                            "first":"Primero",
                            "last":"Último",
                            "next":"Siguiente",
                            "previous":"Anterior"
                        },
                        "search":"Buscar:",
                        "emptyTable": "No Hay Empresas Registradas.",
                    },
                    "destroy":true
                });
</script>

@endsection