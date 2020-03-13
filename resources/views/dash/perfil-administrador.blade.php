@extends('base-other')

@section('contenedor')
<div >
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-3" style="padding-right: 7px">
				<div class="panel-customize">
					<!-- <div class="panel-self-head text-center">
						
					</div> -->
					<div class="panel-boxi">
						<div class="panel-boxi_head text-center">
							
		                        <bs style="font-size: 1.2em">{{ Auth::user()->name }} </b>
		                    
						</div>
						<div class="text-center" style="background-color: #eaecea; height: 120px; position: relative; z-index: 1">
								<img src="{{ url('img/user.png') }}" alt="..." class="img-circle" width="50%" style="position: relative; top: 45px; z-index: 2; border: 5px solid white">
						</div>
						<div class="panel-boxi_body">
							
							<div class="text-center">
								<br>
								<br>
								
								<div class="margin-1-top">
									
				                        <small>{{ Auth::user()->email }}</small>
				                        <br>
				                        <small>ADMINISTRADOR DE CUENTA</small>
								</div>
							</div>
							
							
						</div>
						<div class="border-first_top put-padding-1">
								<b>Empresas:</b>
						</div>
							
						
						
					</div>
					
				</div>
			</div>
			<div class="col-md-9" style="padding-left: 7px">
				<div class="panel-customize">
					<div class="panel-self-head">
						<div class="panel-boxi">
							<div class="panel-boxi_head text-center">
								sdsd
							</div>
							<div class="panel-boxi_body">
								<div class="text-center">
									<img src="{{ url('img/user.png') }}" alt="..." class="img-circle" width="50%">
								</div>
								
							</div>
							
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

	
	
@endsection