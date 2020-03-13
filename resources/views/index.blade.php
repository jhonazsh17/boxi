@extends('base-public')

@section('contenedor')

	<header style="margin-top: 50px;  height: 600px; background-image: url('{{ asset('img/portada.jpg') }}');; background-size: cover">
		<div style="background-color: #00000063; height: 600px">
			<div  style="padding-top: 5em">
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center">
							<h1 style="font-size: 5em; color: white">B O X I</h1>
							<h3 style="color: white; margin-top: 3em">
								Seré tu mejor amigo, te ayudaré a que tengas el control y sepas como va creciendo tu negocio.
							</h3>
						
							<h5 style="color: white; margin-top: 3em">
								No habrá mas excusa que valga, solo registrate.
							</h5>

							<div style="margin-top: 3em">
								<a class="btn btn-default btn-lg" href="{{ url('/register') }}">Registrate</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<main>
		<div class="container" style="margin-top: 3em; margin-bottom: 3em">
			<p class="text-justify" style="font-size: 1.3em; color: #464646">
				Eres dueño de un negocio, no es tan grande, pero tienes ingresos considerables al mes, asi mismo tienes egresos y con ello inumerables operaciones que vas haciendo en el día a día, pero aún estas llevando el típico control de tus ventas y compras en un simple cuaderno ¿Verdad?. Deja de lado eso, soy <b>B<span style="color:#c0392b">O</span><span style="color: #e67e22">XI</span></b>, y estoy aquí para que eso de ahora en adelante cambie.
			</p>
		</div>
	</main>

	<footer style="margin-top: 2em; margin-bottom: 2em">
		<div class="container text-center">
			Derechos Reservados <b>B<span style="color:#c0392b">O</span><span style="color: #e67e22">XI</span></b> - 2018
		</div>
		
	</footer>

@endsection