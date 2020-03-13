@extends('base-other')

@section('contenedor')
<div>
    <br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel-boxi">
                        <div class="panel-boxi_head" style="font-size: 1.2em">
                            <div class="row">
                                <div class="col-md-6">
                                    @if($empresa->logo=="")
                                    <img alt="" src="{{ asset('img') }}/logo-default.png" width="24px">
                                        @else
                                        <img alt="" src="{{ asset('uploads/empresas/logo') }}/{{ $empresa->logo }}" width="24px" style="border: 1px solid orange">
                                            @endif
                                            <b>
                                                {{ $empresa->nombre_comercial }}
                                            </b>
                                            : Administrar
                                        </img>
                                    </img>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a class="btn btn-default btn-xs" href="{{ url('/administracion') }}">
                                        <i class="fa fa-arrow-circle-left">
                                        </i>
                                        Volver Administración
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="panel-boxi_body">
                            <div style="margin-bottom: 10px">
                                Lista de Sucursales/Sedes para Administrar dentro de esta Empresa.
                            </div>
                            <table class="table table-condensed table-hover" id="table-sucursales">
                                <thead>
                                    <tr>
                                        <th>
                                            N°
                                        </th>
                                        <th>
                                            Sucursal/Sede
                                        </th>
                                        <th>
                                            Lugar
                                        </th>
                                        <th>
                                            Dirección
                                        </th>
                                        <th>
                                            Creada
                                        </th>
                                        <th>
                                            Opciones
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; ?>
                                    @foreach($sucursales as $sucursal)
                                    <tr>
                                        <td>
                                            {{ $i=$i+1 }}
                                        </td>
                                        <td>
                                            {{ $sucursal->nombre_sucursal }}
                                        </td>
                                        <td>
                                            {{ $sucursal->lugar }}
                                        </td>
                                        <td>
                                            {{ $sucursal->direccion }}
                                        </td>
                                        <td>
                                            {{ $sucursal->created_at }}
                                        </td>
                                        <td>
                                            <a class="btn btn-default btn-xs" href="{{ url('') }}/{{ $empresa->slug }}/{{ $sucursal->slug }}/dash">
                                                Ir
                                            </a>
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
    </br>
</div>
@endsection

@section('scripts')
<script>
	//---> Dibuja la tabla de sucursales con datatables <--- 
    $('#table-sucursales').DataTable({
    	"order": [[ 4, "desc" ]],
    	"pageLength": 10, 
        "language":{
            "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
            "lengthMenu":"Mostrar _MENU_ Sucursales",
            "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Sucursales",
            "paginate": {
                "first":"Primero",
                "last":"Último",
                "next":"Siguiente",
                "previous":"Anterior"
            },
        	"search":"Buscar:",
        	"emptyTable": "No Hay Sucursales Registradas.",
        },
        "destroy":true
    });
</script>
@endsection
