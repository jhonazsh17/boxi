<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistema BOXI</title>
	<link rel="stylesheet" href="{{ asset('css/app.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
	<link rel="stylesheet" href="{{ asset('css/main.css') }}">
	<script src="https://use.fontawesome.com/1cf0ab8e3f.js"></script>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
	
	<link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('css/easy-autocomplete.css') }}">
	
	<style>
		body{
			background-color: white;
			font-family: 'Noto Sans', sans-serif;


		}
		.navbar-default{
			background-color: #2c3e50;
			border: 0;
			border-radius: 0px;
		}
		.navbar-default .navbar-brand {
		    color: #fff;
		}
		.navbar-default .navbar-nav>li>a, .navbar-default .navbar-text {
		    color: #fff;
		}
		.navbar{
			margin-bottom: 0;
		}
		.home-sector-left{
			background-color: white;
			padding: 1px 1px;
		}
		.home-sector-left_container{
			display: none;
		}
		.home-sector-left_container .nav>li>a{
			padding: 5px 15px;
		}
		.home-sector-left_container .nav>li>a:hover{
			background-color: rgba(230, 126, 34, 0.17);
		    border-radius: 0;
		    color: #000;
		    cursor: pointer;
		    /* font-weight: bold; */
		    border-left: 3px solid #c0392b;
		}
		.home-sector-left_container .nav>li>a:focus{
			background-color: rgba(230, 126, 34, 0.17);
		    border-radius: 0;
		    color: #000;
		    cursor: pointer;
		    /* font-weight: bold; */
		    border-left: 3px solid #c0392b;
		}
		.home-sector-left_container .nav>li>a{
			color: #4b4b4b;
		}
		
		.home-parent-item{
			padding: 5px;
			color: #444;
			
			margin-bottom: 1px;
			background-color: #ddd;
		}
		.home-parent-item:hover{
			cursor: pointer;
		}
		.table>thead>tr>th {
		    vertical-align: bottom;
		    border-bottom: 2px solid #bdc3c7;
    		background-color: #ecf0f1;
		    color: #000;
		    text-align: center;
		}
		.table>tbody>tr>td{
			text-align: center;
		}
		.table{
			font-size: .95em;
		}
		.btn-default {
		    color: #ffffff;
		    background-color: #e67e22;
    		border-color: #c0392b;
		}
		.btn-default:hover {
		    color: #fff;
		    background-color: #c0392b;
		    border-color: #c0392b;
		}
		.col{
			padding-right: 5px;
			padding-left: 5px;
		}
		.fila{
			border-bottom: 1px solid #d6d6d6;
    		margin-bottom: 10px;
		}
		table.dataTable.no-footer {
		    border-bottom: 2px solid #bdc3c7;
		}
		.dataTables_length select{
			height: 30px;
    		line-height: 30px;
    		padding: 5px 10px;
		    font-size: 12px;
		    border-radius: 0px;
		    border: 1px solid #ccd0d2;
		}
		.dataTables_filter input{
			height: 30px;
    		line-height: 30px;
    		padding: 5px 10px;
		    font-size: 12px;
		    border-radius: 0px;
		    border: 1px solid #ccd0d2;
		}
		.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover{
			background: #d35400;
			border: 1px solid #d35400;
			color: #fff !important;
		}
		.form-control{
			border-radius: 3px;
			border:1px solid #bdc3c7;
		}
		.btn-sm, .btn-xs{
			border-radius: 3px;
		}
		.input-group-addon{
			border: 1px solid #bdc3c7;
    		border-radius: 0px;
		}

		.panel{
			border-radius: 0;
		}
		.panel-heading{
			border-top-right-radius: 0px;
    		border-top-left-radius: 0px;

		}
		.panel-default>.panel-heading{
			background-color: #e67e22;
			border-bottom: 3px solid #c0392b;
			color: white;

		}
		.panel-default{
			border-color: #c0392b;
		}
		label{
			color: #000 !important;
		}
		hr{
			border-top: 1px solid #bdc3c7;
		}

		.alert-success {
		    background-color: rgb(44, 62, 80);
		    color: #fff;
		    border: 0px; */
		}
		.alert{
			border-radius: 0;
			padding: 10px 15px;
		}
		.fade-enter-active, .fade-leave-active {
		  transition: opacity .5s
		}
		.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
		  opacity: 0
		}

		.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
		    background: #e67e22;
		    border: 1px solid #c0392b;
		    color: #fff !important;
		    border-radius: 0;
		}

		.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
		    color: white !important;
		    border: 1px solid #c0392b;
		    background-color: #c0392b !important;
		    border-radius: 0;
		    background: linear-gradient(to bottom, #58585800 0%, #1110 100%);
		}

		.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover{
		    
		    color: #fff !important;
		    
		}

		.dataTables_wrapper .dataTables_paginate .paginate_button {
		    padding: 5px;
		}
		
	</style>
</head>
<body onload="javascript:horaFecha()">
	<nav class="navbar navbar-default">
	  <div class="container-fluid">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">B<span style="color:#c0392b">O</span><span style="color: #e67e22">XI</span></a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav">
	        {{-- <li><a href="/home">Panel Principal <span class="sr-only">(current)</span></a></li>
	        {{-- <li><a href="#">Link</a></li> --}} --}}
	        {{-- <li class="dropdown">
	        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ $empresa->nombre }} <span class="caret"></span></a>
	        	<ul class="dropdown-menu" role="menu">
                    	<li>
                            <a href="{{ url('mi-cuenta') }}" >
                                Mi Cuenta
                            </a>

                            
                        </li>
                </ul>
	        </li> --}}
	      </ul>
	      
	      <ul class="nav navbar-nav navbar-right">
	      	@if (Auth::guest())
				<li><a href="#">Usuario</a></li>
	      	@else
				<li class="dropdown">
		        	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="background-color: #192531"> 
		        		@if($empresa->logo=="")
		                    <img src="{{ asset('img') }}/logo-default.png" alt="" width="24px">
		                @else
		                    <img src="{{ asset('uploads/empresas/logo') }}/{{ $empresa->logo }}" alt="" width="24px">
		                @endif  <span class="caret"></span></a>
		        	<ul class="dropdown-menu" role="menu">
	                    	@foreach($empresas as $empresa)
	                    	<li>
	                            <a href="{{ url('') }}/{{ $empresa['slug'] }}/dash" >
	                            	@if($empresa['logo']=="")
					                    <img src="{{ asset('img') }}/logo-default.png" alt="" width="24px">
					                @else
					                    <img src="{{ asset('uploads/empresas/logo') }}/{{ $empresa['logo'] }}" alt="" width="24px">
					                @endif
	                                 {{ $empresa['nombre_comercial'] }}
	                            </a>

	                            
	                        </li>
	                        @endforeach
	                </ul>
		        </li>


				<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <img src="{{ url('img/user.png') }}" alt="..." class="img-circle" width="24px">&nbsp;{{ Auth::user()->name }} 
                    </a>

                    <ul class="dropdown-menu" role="menu">
                    	<li>
                    		
                            <a href="{{ url('mi-cuenta') }}" >
                                Mi Cuenta
                            </a>
							
                            
                        </li>
                        <li>
                            <a href="{{ url('administracion') }}" >
                                Administración
                            </a>

                            
                        </li>
                         <li role="separator" class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Salir
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              	{{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
	      	@endif
	        
	        
	      </ul>
	    </div><!-- /.navbar-collapse -->
	  </div><!-- /.container-fluid -->
	</nav>

	<div id="app-vue">
		@yield('contenedor')

		

	</div>

	
	
	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/bootstrap.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="{{ asset('js/vue.js') }}"></script>
	
	<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
	<script src="{{ asset('js/jquery.easy-autocomplete.js') }}"></script>

	@yield('scripts')
	<script>	
		$('.dropdown-toggle').dropdown();

		
	</script>

	

	
</body>
</html>