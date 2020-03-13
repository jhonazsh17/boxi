@extends('base')

@section('contenedor')

<div class="row-fluid" >
    <div class="col-md-2" id="hsl">

        <div class="home-sector-left_container">
            <div class="text-center" style="padding: 10px">

                @if($empresa->logo=="")
                    <img src="{{ asset('img') }}/logo-default.png" alt="" width="120px" style="margin-bottom: 10px; border: 5px solid #ddd; border-radius:50%">
                @else
                    <img src="{{ asset('uploads/empresas/logo') }}/{{ $empresa->logo }}" alt="" width="120px" style="margin-bottom: 10px; border: 5px solid #ddd; border-radius:50%">
                @endif
                <br>
                <b>{{ $empresa->nombre_comercial }}</b> <br>
                {{ $sucursal->lugar }} <br>
                <small>{{ $sucursal->direccion }}</small>
            </div>
            <div class="home-parent-item"><span class="caret"></span>&nbsp;<b>Menú Principal</b></div>
            <ul class="nav nav-pills nav-stacked">
              <li><a href="#" v-on:click="mostrarPanel" id="menu-principal"><i class="fa fa-tachometer" aria-hidden="true"></i> &nbsp;Panel Principal</a></li>
              <li><a href="#" v-on:click="mostrarVentas" id="menu-ventas"><i class="fa fa-handshake-o" aria-hidden="true"></i> &nbsp;Ventas</a></li>
              <li><a href="#" v-on:click="mostrarCompras" id="menu-compras"><i class="fa fa-cart-plus" aria-hidden="true"></i> &nbsp;Compras </a></li>
              
              <li ><a href="#" v-on:click="mostrarInventarios" id="menu-inventarios"><i class="fa fa-list-alt" aria-hidden="true"></i> &nbsp;Inventarios</a></li>
              
            </ul>
        </div>

        
        <div class="home-sector-left_container">
            <div class="home-parent-item"><span class="caret"></span>&nbsp;<b>Entidades Internas</b></div>
            <ul class="nav nav-pills nav-stacked">
              <li><a  href="#" v-on:click="mostrarProductos" id="menu-productos"><i class="fa fa-archive" aria-hidden="true"></i> &nbsp;Productos</a></li>
              <li><a href="#" v-on:click="mostrarAlmacen" id="menu-almacen"><i class="fa fa-random" aria-hidden="true"></i> &nbsp;Almacén</a></li>
              
            </ul>
        </div>

        <div class="home-sector-left_container">
            <div class="home-parent-item"><span class="caret"></span>&nbsp;<b>Entidades Externas</b></div>
            <ul class="nav nav-pills nav-stacked">
              <li><a href="#" v-on:click="mostrarClientes" id="menu-clientes"><i class="fa fa-users"></i> &nbsp;Clientes</a></li>
              <li><a href="#" v-on:click="mostrarProveedores" id="menu-proveedores"><i class="fa fa-truck"></i> &nbsp;Proveedores</a></li>
              
            </ul>
        </div>
        
    </div>
    <div class="col-md-10 home-sector-right">
        <div class="home-sector-right_principal" v-if="mostrarSector == 0">
            @include('panel/panel')


        </div>
        <template v-if="mostrarSector == 1">
            @include('ventas/ventas')
        </template>
        <template v-if="mostrarSector == 2">
            @include('compras/compras')
        </template>
        <template v-if="mostrarSector == 3">
            @include('productos/productos')
        </template>
        <template v-if="mostrarSector == 4">
            @include('inventarios/inventarios')
        </template>
        <template v-if="mostrarSector == 5">
            @include('almacen/almacen')
        </template>
        <template v-if="mostrarSector == 6">
            @include('clientes/clientes')
        </template>

        <template v-if="mostrarSector == 7">
            @include('proveedores/proveedores')
        </template>

        
        <div class="row-fluid">   
            <div class="col-md-12" style="padding: 0"> 
                @include('footer')
            </div>
        </div>
        
    </div>


    
</div>
  

    

@endsection

@section('scripts')
<script>
    $('#calcular').popover();

    var altoSectorLeft = $(document).height() - 50;

    $('#hsl').css({'height':altoSectorLeft+'px'});
    $('.home-sector-right').css({'height':altoSectorLeft+'px'});
    
    $.ajax({
        type:'get',
        beforeSend: function(){
            //console.log('cargando');
            //$('#hsl').append('<img src="{{ asset("img/loading.GIF") }}" class="loading">');
            $('#hsl').css({'border-right':'1px solid rgb(221, 221, 221)'}); 
        },
        success:function(){
            //console.log('cardago');
            //$('.loading').hide();
            $('#hsl').addClass('home-sector-left');

            $('.home-sector-left_container').css({'display':'block'});
        }
    })



    function horaFecha(){
        var fecha= new Date();
        var horas= fecha.getHours();
        var minutos = fecha.getMinutes();
        var segundos = fecha.getSeconds();

        var anio = fecha.getFullYear();
        var mes = fecha.getMonth();
        var dia = fecha.getDate();

        if(mes<12){
            mes=mes+1;
        }
        else{
            mes=0;
        }


        if(mes<10){
            mes="0"+mes;
        }

        var ampm = (horas >= 12) ? "pm" : "am";

        if(horas<10){
            horas="0"+horas;
        }
        if(minutos<10){
            minutos="0"+minutos;
        }
        if(segundos<10){
            segundos="0"+segundos;
        }

        $('.fechita').val(dia+"/"+mes+"/"+anio);

        $('.horita').val(horas+":"+minutos+":"+segundos);
        $('.horitaampm').text(ampm);

        setTimeout(horaFecha,1000);
    }

    function onClickTipoInventarioDetail(id_inventario){
        app.onClickTipoInventarioDetail(id_inventario);

    }

    function onClickEliminarInventario(id_inventario){
        app.onClickEliminarInventario(id_inventario);
    }

    // función que se dispara cuando se da click en 
    // boton para ver productos de la venta
    function onClickVerProductos(id){
        app.onClickVerProductosEnVenta(id);
    }


Vue.component('my-autocomplete', {
  template: '<input type="text" class="form-control" placeholder="Producto" id="provider-json">',
  mounted: function() {
    

    $.ajax({
        url: "{{ url('ajax/obtener/todos/productos') }}/{{ $sucursal->id }}",
        type:'get',
        success: function(data){
            
            var options = {
                data:data,
                getValue: function(element) {
                    return element.producto+" "+element.cantidad+" "+element.unidad;
                },
                list: {
                    match: {
                        enabled: true
                    },
                    onSelectItemEvent: function() {
                        
                        
                            app.productoVenta.pVenta = $("#provider-json").getSelectedItemData().precio;
                            app.productoVenta.id = $("#provider-json").getSelectedItemData().id;
                            //app.stocksito = $("#provider-json").getSelectedItemData().stock;
                            $.ajax({
                                url: "{{ url('ajax/get/stock') }}/"+$("#provider-json").getSelectedItemData().id,
                                type:'GET',
                                dataType: 'JSON',
                                success: function(data){
                                    app.stocksito = data;
                                }
                            })
                        
                    }
                }
            };

            $("#provider-json").easyAutocomplete(options);
        }
    })
    
    
  }
});

Vue.component('my-autocomplete4', {
  template: '<input type="text" class="form-control " placeholder="Producto" id="provider-json4">',
  mounted: function() {
    

    $.ajax({
        url: "{{ url('ajax/obtener/todos/productos') }}/{{ $sucursal->id }}",
        type:'get',
        success: function(data){
            
            var options = {
                data:data,
                getValue: function(element) {
                    return element.producto+" "+element.cantidad+" "+element.unidad;
                },
                list: {
                    match: {
                        enabled: true
                    },
                    onSelectItemEvent: function() {
                        
                        
                           
                            app.productoCompra.id = $("#provider-json4").getSelectedItemData().id;

                            
                        
                    }
                }
            };

            $("#provider-json4").easyAutocomplete(options);
        }
    })
    
    
  }
});
    


Vue.component('my-autocomplete2', {
  template: '<input type="text" class="form-control" placeholder="DNI/RUC" id="provider-json2" style="width:130px">',
  mounted: function() {

    $.ajax({
        url: "{{ url('ajax/obtener/todos/clientes') }}/{{ $empresa->id }}",
        type:'get',
        dataType:'JSON',
        success: function(data){
            
            console.log(data);

            var options = {
                data:data,
                getValue: function(element) {
                    var doc;
                    if(element.ruc!=0){
                        doc = element.ruc;
                    }else{
                        doc = element.dni;
                    }
                    
                    return doc+""
                },
                list: {
                    match: {
                        enabled: true
                    },
                    onSelectItemEvent: function() {
   
                        app.venta.cliente = $("#provider-json2").getSelectedItemData().nombre;
                        app.venta.doc = $("#provider-json2").getSelectedItemData().dni;

                        
                    }
                }
            };

            $("#provider-json2").easyAutocomplete(options);
        }
    })
    
    
  }
});

Vue.component('my-autocomplete3', {
  template: '<input type="text" class="form-control" placeholder="DNI/RUC" id="provider-json3" style="width:130px">',
  mounted: function() {

    $.ajax({
        url: "{{ url('ajax/obtener/todos/proveedores') }}/{{ $empresa->id }}",
        type:'get',
        dataType:'JSON',
        success: function(data){
            
            console.log(data);

            var options = {
                data:data,
                getValue: function(element) {
                    var doc;
                    if(element.ruc!=0){
                        doc = element.ruc;
                    }else{
                        doc = element.dni;
                    }
                    
                    return doc+""
                },
                list: {
                    match: {
                        enabled: true
                    },
                    onSelectItemEvent: function() {
   
                        app.compra.proveedor = $("#provider-json3").getSelectedItemData().nombre;
                        
                    }
                }
            };

            $("#provider-json3").easyAutocomplete(options);
        }
    })
    
    
  }
});
    
</script>

<script>
    var app = new Vue({
        el:"#app-vue",
        data:{
            mostrarSector: 0,

            mostrarSectorHacerVentaItem:true,
            mostrarSectorVentasItem:false,

            mostrarSectorEfectuarCompraItem: true,
            mostrarSectorComprasItem: false,

            mostrarSectorCrearProductosItem: true,
            mostrarSectorProductosItem: false,
            mostrarSectorCategoriaProductosItem: false,
            mostrarSectorUnidadesMedidaItem: false,
            mostrarAgregarProductosItem: true,

            mostrarAgregarProductosComprasItem: true,

            mostrarSectorHacerInventarioItem: false,
            mostrarSectorInventariosItem: true,
            mostrarSectorEliminarInv: false,

            mostrarSectorAlmacenItem: true,
            mostrarSectorStockProductoItem: false,

            mostrarSectorClientesItem: true,
            mostrarSectorProveedoresItem: true,

            categoriaValue: "",
            unidadValue: "",
            unidadAbrevValue: "",
            todoProductos: [],

            producto:{
                codigo:"",
                producto:"",
                nombre_comercial:"",
                id_categoria:"",
                categoria:"",
                cantidad:"0",
                unidad:"",
                id_unidad:"",
                stock:"0",
                pUnitario:"0.00"
            },

            stocksito:"",

            productoVenta:{
                id:"",
                producto:"",
                cantidad: "1",
                pVenta:""
            },
            itemsVenta: [],
            itemsCompra: [],
            totalVenta: 0.00,
            totalCompra: 0.00,
            messageErrorStock:false,
            messageErrorVacioVenta: false,
            tablaVentas:1,

            tablaCompras:1,

            venta:{
                tipoDoc:"Boleta de Venta",
                nroDoc:"",
                doc:"",
                cliente:"",
                tipo:"",
                nro:"",
                monto: 0.00
            },

            productoCompra:{
                id:"",
                producto:"",
                cantidad: "1",
                pCompra:"0.00",

            },

            compra:{
                tipoDoc:"Boleta de Venta",
                nroDoc:"",
                doc:"",
                proveedor:"",
                nro:"",
                monto: 0.00
            },

            ventaDia:"",

            verVenta:{},
            styleScroll: "height:100px;overflow-y:auto",

            listaProductos:[],

            seleccionarActivate : false,

            categorias:[],
            unidades: [],

            // fechaHora:{
            //     fecha:"",
            //     hora:""
            // },
            consumo:true,

            calcular:{
                cantidad:"0",
                monto:"0.00",
                pCompra: '0.00' 
            },

            mostrarOpcion: 1,
            loading:false,
            loading_message:false,
            no_loading_message:false,
            loading_message_und:false,
            no_loading_message_und:false,
            no_loading:true,

            mensajeProductoEnviado:"",

            productosVarios:[],
            productosArray: [],
            agregar:0,

            //
            inventario: {
                tipo:"",
                fechaInicio:"",
                fechaFinal:"",
                observacion:"",
                id_pertenencia_almacen_filtro:{{$almacen->id}}
            },

            inventarioAux: {
                tipo:"",
                fechaInicio:"",
                fechaFinal:"",
                observacion:""
            },
            tipoInventarios:[],

            cantidadDeProductosEnInventario : "",
            code:"",
            inventarioItemEditar:{},
            idinv:"",
            provUnidadInv: "",
            provCategoriaInv:"",
            mostrarCrearInventario:true,
            productosInventario:[],
            productosVariosInventario:[],
            mostrarAgregarProductosInventario : 1,
            mostrarSectorMensajeNoInventarioItem : false,

            //data para estilos menu productos
            productosMenu:{
                productoNuevo:"",
            },

            //
            comprasHoyPanel:0,
            comprasHoyPanelLogic: false,
            comprasMesPanel:0,
            comprasMesPanelLogic: false,
            ventasHoyPanel:0,
            ventasHoyPanelLogic: false,
            ventasMesPanel:0,
            ventasMesPanelLogic: false,


        },
        created: function(){
            this.ajaxGetAllCategorias();
            this.ajaxGetAllUnidades();
            this.ajaxGetTipoInventarios();
            setTimeout(function(){
                app.ajaxGetComprasHoy();
                app.ajaxGetVentasHoy();
                app.ajaxGetVentasMes();
                app.ajaxGetComprasMes();
            }, 5);
            
            
            
        },
        methods:{
            /* ===/ Funciones o métodos reutilizables /=== */

            //-->obtener via ajax todas las categorias de productos
            ajaxGetAllCategorias: function(){
                $.ajax({
                    url: '{{ url("ajax/obtener/all/categorias") }}',
                    type: 'get',
                    dataType: 'json',
                    success: function(data){
                        for (var i = 0; i < data.length; i++) {
                            app.categorias.push({
                                id:data[i]['id'],
                                nombre:data[i]['nombre']
                            });
                        }
                    }
                })
            },

            //-->Obtener via ajax todas las unidades de medida
            ajaxGetAllUnidades: function(){
                $.ajax({
                    url: '{{ url("ajax/obtener/all/unidades") }}',
                    type: 'get',
                    dataType: 'json',
                    success: function(data){
                        for (var i = 0; i < data.length; i++) {
                            app.unidades.push({
                                id:data[i]['id'],
                                unidad:data[i]['unidad'],
                                abreviatura: data[i]['abreviatura']
                            });
                        }
                    }
                })
            },

            ajaxGetTipoInventarios: function(){
                $.ajax({
                    url: '{{ url("ajax/obtener/all/tipo-inventario") }}/{{$empresa->id}}',
                    type: 'get',
                    dataType: 'json',
                    success: function(data){
                        for (var i = 0; i < data.length; i++) {
                            app.tipoInventarios.push({
                                id:data[i]['id'],
                                nombre:data[i]['nombre'],
                                
                            });
                        }
                    }
                })
            },

            ajaxGetComprasHoy: function(){
                $.ajax({
                    url:'{{ url("ajax/obtener/compras/hoy/sincronice") }}/{{ $sucursal->id }}',
                    type:'GET',
                    dataType: 'JSON',
                    beforeSend: function(){
                        app.comprasHoyPanelLogic = false;
                    },
                    success: function(data){
                        app.comprasHoyPanelLogic = true;
                        app.comprasHoyPanel = data;
                    }
                })
            },

            ajaxGetVentasHoy: function(){
                $.ajax({
                    url:'{{ url("ajax/obtener/ventas/hoy/sincronice") }}/{{ $sucursal->id }}',
                    type:'GET',
                    dataType: 'JSON',
                    beforeSend: function(){
                        app.ventasHoyPanelLogic = false;
                    },
                    success: function(data){
                        app.ventasHoyPanelLogic = true;
                        app.ventasHoyPanel = data;
                    }
                })
            },

            ajaxGetVentasMes: function(){
                $.ajax({
                    url:'{{ url("ajax/obtener/ventas/mes/sincronice") }}/{{ $sucursal->id }}',
                    type:'GET',
                    dataType: 'JSON',
                    beforeSend: function(){
                        app.ventasMesPanelLogic = false;
                    },
                    success: function(data){
                        app.ventasMesPanelLogic = true;
                        app.ventasMesPanel = data;
                    }
                })
            },

            ajaxGetComprasMes: function(){
                $.ajax({
                    url:'{{ url("ajax/obtener/compras/mes/sincronice") }}/{{ $sucursal->id }}',
                    type:'GET',
                    dataType: 'JSON',
                    beforeSend: function(){
                        app.comprasMesPanelLogic = false;
                    },
                    success: function(data){
                        app.comprasMesPanelLogic = true;
                        app.comprasMesPanel = data;
                    }
                })
            },

            //--->Reseteo de atributos de objeto Producto
            resetFormProducto: function(){
                this.producto.producto = "";
                this.producto.nombre_comercial = "";
                this.producto.codigo = "";
                this.producto.categoria = "";
                this.producto.id_categoria = "";
                this.producto.cantidad = "0";
                this.producto.unidad = "";
                this.producto.id_unidad = "";
                this.producto.stock = "0";
                this.producto.pUnitario = "0.00";
            },

            generateCodeProducto: function(cadena){
                var sub = cadena.slice(0,3);
                var fecha = new Date();

                var code = sub+fecha.getDate()+fecha.getMonth()+fecha.getYear()+fecha.getHours()+fecha.getMinutes()+fecha.getSeconds();

                return code.toUpperCase();
            },

            /* =======/ Fin Funciones Reutilizables /======= */

            mostrarPanel: function(){
                this.mostrarSector = 0;

                $('#menu-ventas').removeAttr('style');
                $('#menu-almacen').removeAttr('style');
                $('#menu-clientes').removeAttr('style');
                $('#menu-compras').removeAttr('style');
                $('#menu-inventarios').removeAttr('style');
                $('#menu-productos').removeAttr('style');
                $('#menu-proveedores').removeAttr('style');
                $('#menu-principal').css({
                    'background-color':'rgba(230, 126, 34, 0.17)',
                    'border-radius':'0',
                    'color':'#000',
                    'border-left':'3px solid #c0392b'
                });

                this.mostrarSectorInventariosItem = false;
                this.mostrarSectorHacerInventarioItem = false;

                app.ajaxGetComprasHoy();
                app.ajaxGetVentasHoy();
                app.ajaxGetComprasMes();
                app.ajaxGetVentasMes();
                
            },
            mostrarVentas: function(){
                this.mostrarSector = 1;
                this.venta.tipo = "1";

                this.mostrarSectorVentasItem = false;
                this.mostrarSectorHacerVentaItem = true;

                setTimeout(function(){
                    $('.home-sector-right_menu>.nav-pills>li>#hacer-venta').css({
                        'border-radius': '0px',
                        'padding': '8px 10px 5px 10px',
                        'margin-bottom': '1px',
                        'border-bottom': '3px solid #e67e22',
                        'color': '#000',
                        'background-color': '#eee'
                    });
                }, 50);

                

                this.mostrarSectorHacerVentaItem = true;
                this.mostrarSectorVentasItem = false;

                

                $('#menu-inventarios').removeAttr('style');
                $('#menu-compras').removeAttr('style');
                $('#menu-clientes').removeAttr('style');
                $('#menu-productos').removeAttr('style');
                $('#menu-almacen').removeAttr('style');
                $('#menu-principal').removeAttr('style');
                $('#menu-proveedores').removeAttr('style');
                $('#menu-ventas').css({
                    'background-color':'rgba(230, 126, 34, 0.17)',
                    'border-radius':'0',
                    'color':'#000',
                    'border-left':'3px solid #c0392b'
                });
                
            },
            mostrarCompras: function(){
                this.mostrarSector = 2;

                this.mostrarSectorEfectuarCompraItem = true;
                this.mostrarSectorComprasItem = false;

                setTimeout(function(){
                    $('.home-sector-right_menu>.nav-pills>li>#hacer-compra').css({
                        'border-radius': '0px',
                        'padding': '8px 10px 5px 10px',
                        'margin-bottom': '1px',
                        'border-bottom': '3px solid #e67e22',
                        'color': '#000',
                        'background-color': '#eee'
                    });
                    $('.home-sector-right_menu>.nav-pills>li>#ver-compras').removeAttr('style');
                }, 50);
                

                $('#menu-ventas').removeAttr('style');
                $('#menu-almacen').removeAttr('style');
                $('#menu-inventarios').removeAttr('style');
                $('#menu-principal').removeAttr('style');
                $('#menu-productos').removeAttr('style');
                $('#menu-clientes').removeAttr('style');
                $('#menu-proveedores').removeAttr('style');
                $('#menu-compras').css({
                    'background-color':'rgba(230, 126, 34, 0.17)',
                    'border-radius':'0',
                    'color':'#000',
                    'border-left':'3px solid #c0392b'
                });
            },
            mostrarProductos: function(){
                this.mostrarSector = 3;

                this.mostrarSectorCrearProductosItem = false;
                this.mostrarSectorProductosItem = true;
                this.mostrarSectorCategoriaProductosItem = false;
                this.mostrarSectorUnidadesMedidaItem = false;

                $('#menu-ventas').removeAttr('style');
                $('#menu-principal').removeAttr('style');
                $('#menu-compras').removeAttr('style');
                $('#menu-inventarios').removeAttr('style');
                $('#menu-almacen').removeAttr('style');
                $('#menu-clientes').removeAttr('style');
                $('#menu-proveedores').removeAttr('style');
                $('#menu-productos').css({
                    'background-color':'rgba(230, 126, 34, 0.17)',
                    'border-radius':'0',
                    'color':'#000',
                    'border-left':'3px solid #c0392b'
                });

                setTimeout(function(){
                    app.mostrarSectorProductos();
                }, 10);
                

            },
            mostrarInventarios: function(){
                this.mostrarSector = 4;
                
                $('#menu-ventas').removeAttr('style');
                $('#menu-almacen').removeAttr('style');
                $('#menu-clientes').removeAttr('style');
                $('#menu-productos').removeAttr('style');
                $('#menu-compras').removeAttr('style');
                $('#menu-principal').removeAttr('style');
                $('#menu-proveedores').removeAttr('style');
                $('#menu-inventarios').css({
                    'background-color':'rgba(230, 126, 34, 0.17)',
                    'border-radius':'0',
                    'color':'#000',
                    'border-left':'3px solid #c0392b'
                });

                

                setTimeout(function(){
                    $('.home-sector-right_menu>.nav-pills>li>#lista-inventarios').css({
                        'border-radius': '0px',
                        'padding': '8px 10px 5px 10px',
                        'margin-bottom': '1px',
                        'border-bottom': '3px solid #e67e22',
                        'color': '#000',
                        'background-color': '#eee'
                    });

                    app.mostrarSectorInventarios();
                },100);
                
            },
            mostrarAlmacen: function(){
                this.mostrarSector = 5;

                $('#menu-clientes').removeAttr('style');
                $('#menu-inventarios').removeAttr('style');
                $('#menu-ventas').removeAttr('style');
                $('#menu-compras').removeAttr('style');
                $('#menu-productos').removeAttr('style');
                $('#menu-principal').removeAttr('style');
                $('#menu-proveedores').removeAttr('style');
                $('#menu-almacen').css({
                    'background-color':'rgba(230, 126, 34, 0.17)',
                    'border-radius':'0',
                    'color':'#000',
                    'border-left':'3px solid #c0392b'
                });

                setTimeout(function(){
                    app.mostrarSectorAlmacen();
                }, 100);
            },

            mostrarClientes: function(){
                this.mostrarSector = 6;
                this.mostrarSectorVentasItem = false;
                this.mostrarSectorHacerVentaItem = true;
                $('#menu-inventarios').removeAttr('style');
                $('#menu-ventas').removeAttr('style');
                $('#menu-almacen').removeAttr('style');
                $('#menu-compras').removeAttr('style');
                $('#menu-principal').removeAttr('style');
                $('#menu-productos').removeAttr('style');
                $('#menu-proveedores').removeAttr('style');
                $('#menu-clientes').css({
                    'background-color':'rgba(230, 126, 34, 0.17)',
                    'border-radius':'0',
                    'color':'#000',
                    'border-left':'3px solid #c0392b'
                });
                setTimeout(function(){
                    app.mostrarSectorClientes();
                },100);
                

            },

            mostrarProveedores: function(){
                this.mostrarSector = 7;
                
                $('#menu-inventarios').removeAttr('style');
                $('#menu-ventas').removeAttr('style');
                $('#menu-almacen').removeAttr('style');
                $('#menu-compras').removeAttr('style');
                $('#menu-principal').removeAttr('style');
                $('#menu-productos').removeAttr('style');
                $('#menu-clientes').removeAttr('style');
                $('#menu-proveedores').css({
                    'background-color':'rgba(230, 126, 34, 0.17)',
                    'border-radius':'0',
                    'color':'#000',
                    'border-left':'3px solid #c0392b'
                });
                setTimeout(function(){
                    app.mostrarSectorProveedores();
                },100);
                

            },

            mostrarSectorProveedores: function(){
                this.mostrarSectorProveedoresItem = true;

                $('#table-proveedores').DataTable({
                    "ajax": '{{ url("ajax/obtener/proveedores") }}/{{ $empresa->id }}',
                    "columns": [
                        { "data": "check" },
                        { "data": "numero" },
                        { "data": "proveedor" },
                         {"data": "dni" },
                         {"data": "ruc" },
                        { "data": "created_at" },
                                                
                        { "data": "updated_at" },
                        { "data": "opciones" },
                    ],
                    "order": [[ 1, "desc" ]],
                    "pageLength": 10, 
                    "language":{
                        "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                        "lengthMenu":"Mostrar _MENU_ Proveedores",
                        "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Proveedores",
                        "paginate": {
                            "first":"Primero",
                            "last":"Último",
                            "next":"Siguiente",
                            "previous":"Anterior"
                        },
                        "search":"Buscar:",
                        "emptyTable": "No Hay Proveedores Registrados.",
                    },
                    "destroy":true
                });
            },


            mostrarSectorClientes: function(){
                this.mostrarSectorClientesItem = true;

                $('#table-clientes').DataTable({
                    "ajax": '{{ url("ajax/obtener/clientes") }}/{{ $empresa->id }}',
                    "columns": [
                        { "data": "check" },
                        { "data": "numero" },
                        { "data": "cliente" },
                         {"data": "dni" },
                         {"data": "ruc" },
                        { "data": "created_at" },
                                                
                        { "data": "updated_at" },
                        { "data": "opciones" },
                    ],
                    "order": [[ 1, "desc" ]],
                    "pageLength": 10, 
                    "language":{
                        "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                        "lengthMenu":"Mostrar _MENU_ Clientes",
                        "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Clientes",
                        "paginate": {
                            "first":"Primero",
                            "last":"Último",
                            "next":"Siguiente",
                            "previous":"Anterior"
                        },
                        "search":"Buscar:",
                        "emptyTable": "No Hay Clientes Registradas.",
                    },
                    "destroy":true
                });
            },

            //---
            
            mostrarSectorHacerVenta: function(){
                this.mostrarSectorHacerVentaItem = true;
                this.mostrarSectorVentasItem = false;
                this.venta.tipo = "1";
                
                $('.home-sector-right_menu>.nav-pills>li>#hacer-venta').css({
                    'border-radius': '0px',
                    'padding': '8px 10px 5px 10px',
                    'margin-bottom': '1px',
                    'border-bottom': '3px solid #e67e22',
                    'color': '#000',
                    'background-color': '#eee'
                });
                $('.home-sector-right_menu>.nav-pills>li>#ver-ventas').removeAttr('style');
                
            },
            clickConsumoPropio: function(){
                if($('#checkConsumo').is(':checked')){
                    this.consumo = false;
                }else{
                    this.consumo = true;
                }
            },
            mostrarSectorVentas: function(){
                this.mostrarSectorVentasItem = true;
                this.mostrarSectorHacerVentaItem = false;
                
                $('.home-sector-right_menu>.nav-pills>li>#ver-ventas').css({
                    'border-radius': '0px',
                    'padding': '8px 10px 5px 10px',
                    'margin-bottom': '1px',
                    'border-bottom': '3px solid #e67e22',
                    'color': '#000',
                    'background-color': '#eee'
                });
                $('.home-sector-right_menu>.nav-pills>li>#hacer-venta').removeAttr('style');

                $('#table-ventas').DataTable({
                    "ajax": '{{ url("ajax/obtener/ventas") }}/{{ $sucursal->id }}',
                    "columns": [
                        { "data": "check" },
                        { "data": "numero" },
                        { "data": "created_at" },
                        { "data": "tipo" },
                        { "data": "documento" },

                        { "data": "cliente" },
                        { "data": "productos" },
                        { "data": "monto"},
                        
                        { "data": "updated_at" },
                        { "data": "opciones" },
                    ],
                    "order": [[ 1, "desc" ]],
                    "pageLength": 10, 
                    "language":{
                        "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                        "lengthMenu":"Mostrar _MENU_ Ventas",
                        "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Ventas",
                        "paginate": {
                            "first":"Primero",
                            "last":"Último",
                            "next":"Siguiente",
                            "previous":"Anterior"
                        },
                        "search":"Buscar:",
                        "emptyTable": "No Hay Ventas Registradas.",
                    },
                    "destroy":true
                });
          
            },
            mostrarSectorEfectuarCompra: function(){
                $('.home-sector-right_menu>.nav-pills>li>#hacer-compra').css({
                    'border-radius': '0px',
                    'padding': '8px 10px 5px 10px',
                    'margin-bottom': '1px',
                    'border-bottom': '3px solid #e67e22',
                    'color': '#000',
                    'background-color': '#eee'
                });
                $('.home-sector-right_menu>.nav-pills>li>#ver-compras').removeAttr('style');

                this.mostrarSectorEfectuarCompraItem = true;
                this.mostrarSectorComprasItem = false;
            },

            mostrarSectorCompras: function(){
                $('.home-sector-right_menu>.nav-pills>li>#ver-compras').css({
                    'border-radius': '0px',
                    'padding': '8px 10px 5px 10px',
                    'margin-bottom': '1px',
                    'border-bottom': '3px solid #e67e22',
                    'color': '#000',
                    'background-color': '#eee'
                });
                $('.home-sector-right_menu>.nav-pills>li>#hacer-compra').removeAttr('style');

                this.mostrarSectorEfectuarCompraItem = false;
                this.mostrarSectorComprasItem = true;
                $('.table-compras').DataTable({
                    "ajax": '{{ url("ajax/obtener/compras") }}/{{ $sucursal->id }}',
                    "columns": [
                        { "data": "check" },
                        { "data": "numero" },
                        { "data": "created_at" },
                        { "data": "documento" },

                        { "data": "proveedor" },
                        { "data": "productos" },
                        { "data": "monto"},
                        
                        { "data": "updated_at" },
                        { "data": "opciones" },
                    ],
                    "order": [[ 1, "desc" ]],
                    "pageLength": 10, 
                    "language":{
                        "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                        "lengthMenu":"Mostrar _MENU_ Compras",
                        "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Compras",
                        "paginate": {
                            "first":"Primero",
                            "last":"Último",
                            "next":"Siguiente",
                            "previous":"Anterior"
                        },
                        "search":"Buscar:",
                        "emptyTable": "No Hay Compras Registradas.",
                    },
                    "destroy":true
                });
            },
            
            //-->Método para crear un nuevo producto o nuevos varios productos
            mostrarSectorCrearProductos: function(){
                this.mostrarSectorCrearProductosItem = true;
                this.mostrarSectorProductosItem = false;
                this.mostrarSectorCategoriaProductosItem = false;
                this.mostrarSectorUnidadesMedidaItem = false;

                this.productosMenu.productoNuevo = "background-color: rgb(230, 126, 34); color: white; font-weight:bold";
                this.productosMenu.productos = "";
                this.productosMenu.categorias = "";
                this.productosMenu.unidades = "";

            },

            //-->Método que se activa al ver la lista de productos
            mostrarSectorProductos: function(){
                $('#load-time2').hide();
                $('#load-time').show();

                //ocultando los demas sectores excepto el de productos (lista)
                this.mostrarSectorCrearProductosItem = false;
                this.mostrarSectorProductosItem = true;
                this.mostrarSectorCategoriaProductosItem = false;
                this.mostrarSectorUnidadesMedidaItem = false;

                //pintando solo el boton del menu de productos (lista)
                this.productosMenu.productoNuevo = "";
                this.productosMenu.productos = "background-color: rgb(230, 126, 34); color: white; font-weight:bold";
                this.productosMenu.categorias = "";
                this.productosMenu.unidades = "";

                $('#table-productos').DataTable({
                    "ajax": '{{ url("ajax/obtener/productos") }}/{{ $sucursal->id }}',
                    "columns": [
                        { "data": "check" },
                        { "data": "numero" },
                        { "data": "codigo" },
                        { "data": "producto" },
                        { "data": "nombre_comercial" },
                        { "data": "categoria" },
                        { "data": "presentacion" },
                        { "data": "created_at" },
                        { "data": "updated_at" },
                        { "data": "opciones" },
                    ],
                    "order": [[ 1, "desc" ]],
                    "pageLength": 10, 
                    "language":{
                        "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                        "lengthMenu":"Mostrar _MENU_ Productos",
                        "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Productos",
                        "paginate": {
                            "first":"Primero",
                            "last":"Último",
                            "next":"Siguiente",
                            "previous":"Anterior"
                        },
                        "search":"Buscar:",
                        "emptyTable": "No Hay Productos Registrados.",
                    },
                    "destroy":true
                });


            },
            mostrarSectorCategoriaProductos: function(){
                this.mostrarSectorCrearProductosItem = false;
                this.mostrarSectorProductosItem = false;
                this.mostrarSectorCategoriaProductosItem = true;
                this.mostrarSectorUnidadesMedidaItem = false;

                this.productosMenu.productoNuevo = "";
                this.productosMenu.productos = "";
                this.productosMenu.categorias = "background-color: rgb(230, 126, 34); color: white; font-weight:bold";
                this.productosMenu.unidades = "";

                $('.table-categorias').DataTable({
                    "language":{
                        "lengthMenu":"Mostrar _MENU_ Categorías",
                        "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Categorías",
                        "paginate": {
                            "first":"Primero",
                            "last":"Último",
                            "next":"Siguiente",
                            "previous":"Anterior"
                        },
                        "search":"Buscar:",
                        "emptyTable": "No Hay Categorías Registradas.",
                    },
                    "destroy": true
                });


                
            },

            mostrarSectorUnidadesMedida: function(){
                this.mostrarSectorCrearProductosItem = false;
                this.mostrarSectorProductosItem = false;
                this.mostrarSectorCategoriaProductosItem = false;
                this.mostrarSectorUnidadesMedidaItem = true;

                this.productosMenu.productoNuevo = "";
                this.productosMenu.productos = "";
                this.productosMenu.categorias = "";
                this.productosMenu.unidades = "background-color: rgb(230, 126, 34); color: white";

                $('.table-unidades').DataTable({
                    "language":{
                        "lengthMenu":"Mostrar _MENU_ Unidades de Medida",
                        "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Unidades de Medida",
                        "paginate": {
                            "first":"Primero",
                            "last":"Último",
                            "next":"Siguiente",
                            "previous":"Anterior"
                        },
                        "search":"Buscar:",
                        "emptyTable": "No Hay Unidades de Medida Registradas.",
                    },
                    "destroy": true
                });
            },

            guardarCategoria: function(){
                var token = $("#token_categoria").val();  
                //console.log(token);

                $.ajax({
                    headers: {'X-CSRF-Token':token},
                    url:"{{ url('/ajax/crear/categoria') }}",
                    data: {categoria:this.categoriaValue},
                    type:'POST',
                    success: function(data){
                        
                        var html = "<tr><td>"+data['id']+"</td><td>"+data['nombre_categoria']+"</td><td>"+data['created_at']+"</td><td>"+data['updated_at']+"</td><td><button class='btn btn-default btn-xs'><i class='fa fa-trash' aria-hidden='true'></i></button>&nbsp;<button class='btn btn-default btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td></tr>";

                        $('.categoria-for').append(html);

                    }
                });

                this.categoriaValue = "";
                this.unidadAbrevValue = "";
                
            },

            guardarUnidad: function(){
                var token = $("#token_unidad").val();  
                //console.log(token);

                $.ajax({
                    headers: {'X-CSRF-Token':token},
                    url:"{{ url('/ajax/crear/unidad') }}",
                    data: {unidad:this.unidadValue,abreviatura:this.unidadAbrevValue},
                    type:'POST',
                    success: function(data){
                        
                        var html = "<tr><td>"+data['id']+"</td><td>"+data['unidad']+"</td><td>"+data['abreviatura']+"</td><td>"+data['created_at']+"</td><td>"+data['updated_at']+"</td><td><button class='btn btn-default btn-xs'><i class='fa fa-trash' aria-hidden='true'></i></button>&nbsp;<button class='btn btn-default btn-xs'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button></td></tr>";

                        $('.unidad-for').append(html);

                    }
                });

                this.unidadValue = "";
                this.unidadAbrevValue = "";
                
            },

            guardarProducto: function(){
                var token = $("#token_producto").val(); 

                $.ajax({
                    headers: {'X-CSRF-Token':token},
                    url:"{{ url('/ajax/crear/producto') }}",
                    data: {
                        codigo:this.producto.codigo,
                        producto:this.producto.producto,
                        nombre_comercial:this.producto.nombre_comercial,
                        id_categoria:this.producto.id_categoria,
                        cantidad:this.producto.cantidad,
                        id_unidad:this.producto.id_unidad,
                        pUnitario: this.producto.pUnitario
                    },
                    type:'POST',
                    beforeSend: function(){
                        app.loading = true;
                        app.no_loading = false;
                        
                    },
                    success: function(data){

                        app.mostrarSectorCrearProductosItem = false;
                        app.mostrarSectorProductosItem = true;

                        app.loading = false;
                        app.no_loading = true;

                        app.mostrarSectorProductos();

                        app.producto.codigo="";
                        app.producto.producto="";
                        app.producto.nombre_comercial="";
                        app.producto.id_categoria="";
                        app.producto.categoria="";
                        app.producto.cantidad="";
                        app.producto.unidad="";
                        app.producto.id_unidad="";
                        app.producto.pUnitario="";

                        
                    }
                    
                });
                
   
            },

            

            onChangeCategoria: function(){
                

                $.ajax({
                    url:'/ajax/obtener/categoria/'+this.producto.id_categoria,
                    type:'get',
                    beforeSend: function(){
                        app.loading_message = true;
                        app.no_loading_message = false;
                    },
                    success: function(data){
                        app.loading_message = false;
                        app.no_loading_message = true;
                        app.producto.categoria = data['nombre'];
                    }
                });
            },

            onChangeUnidad: function(){
                $.ajax({
                    url:'/ajax/obtener/unidad/'+this.producto.id_unidad,
                    type:'get',
                    beforeSend: function(){
                        app.loading_message_und = true;
                        app.no_loading_message_und = false;
                    },
                    success: function(data){
                        app.loading_message_und = false;
                        app.no_loading_message_und = true;
                        app.producto.unidad = data['abreviatura'];
                    }
                });
            },

            changeNumber:  function(){
                this.mostrarAgregarProductosItem = false;
            },

            accionMostrarOpcion: function(){
                app.producto.codigo="";
                app.producto.producto="";
                app.producto.nombre_comercial="";
                app.producto.id_categoria="";
                app.producto.categoria="";
                app.producto.cantidad="";
                app.producto.unidad="";
                app.producto.id_unidad="";

                if(this.mostrarOpcion==2){
                    $('#mitad-1').removeClass('col-md-8');
                    $('#mitad-2').removeClass('col-md-4');

                    $('#mitad-1').addClass('col-md-6');
                    $('#mitad-2').addClass('col-md-6');
                }else{
                    $('#mitad-1').removeClass('col-md-6');
                    $('#mitad-2').removeClass('col-md-6');

                    $('#mitad-1').addClass('col-md-8');
                    $('#mitad-2').addClass('col-md-4');
                }
                
                
                this.productosVarios = [];
                this.cuantosProductos = 0;
                this.agregar = 0;
                this.mostrarAgregarProductosItem = true;
            },

            

            //--> Método que se activa al hacer click en agregar producto
            agregarProducto: function(){


                //evalua los campos del formulario si no estan vacíos
                if(this.producto.producto!=""&&this.producto.codigo!=""&&this.producto.id_categoria!=""&&this.producto.cantidad!=""&&this.producto.id_unidad!=""){

                    var categoria;
                    var unidad;

                    $('#seleccionar-varios').removeAttr('disabled');

                    //evalua si cuantos productos se van agregar
                    if(this.agregar < $('#numberCuantos').val()){

                        //colocando un nuevo producto en el array para la base de datos
                        this.productosArray.push({
                            producto: this.producto.producto,
                            nombre_comercial: this.producto.nombre_comercial,
                            codigo: this.producto.codigo,
                            categoria: this.producto.id_categoria,
                            cantidad: this.producto.cantidad,
                            unidad: this.producto.id_unidad,
                            pUnitario: this.producto.pUnitario
                        });

                        //valor que hace el muestreo de agregar producto a la tabla
                        this.mostrarAgregarProductosItem=false;

                        //valor que aumenta cuando se agrega un nuevo producto
                        this.agregar = this.agregar+1;

                        //obtiene el nombre de categoria
                        for (var i = 0; i < this.categorias.length; i++) {
                            if(this.categorias[i]['id']==this.producto.id_categoria){
                                categoria = this.categorias[i]['nombre'];
                            }
                        }

                        //obtiene la abreviatura de la unidad
                        for (var i = 0; i < this.unidades.length; i++) {
                            if(this.unidades[i]['id']==this.producto.id_unidad){
                                unidad = this.unidades[i]['abreviatura'];
                            }
                        }

                        //colocando un nuevo producto en el array de muestreo
                        this.productosVarios.push({
                            producto: this.producto.producto,
                            nombre_comercial: this.producto.nombre_comercial,
                            codigo: this.producto.codigo,
                            categoria: categoria,
                            cantidad: this.producto.cantidad,
                            unidad: unidad,
                            pUnitario: this.producto.pUnitario
                        });

                        //llamada a función para reseteo a vacío del objeto producto
                        this.resetFormProducto();

                    }

                    //caso contrario
                    else{

                        $('#cont-msg-form').fadeIn();
                        $('#msg-form-prod').text('Debes cambiar el valor de ¿Cuántos Productos? vas agregar.');

                        $('#numberCuantos').css({
                            'background-color':'#fdff67'
                        });

                        //temporizador de 3 seg.
                        setTimeout(function(){
                            $('#cont-msg-form').fadeOut();

                            $('#numberCuantos').css({
                                'background-color':'#ffffff'
                            });
                        }, 3000);
                            
                    }

                    
                }

                //caso contrario si estan vacíos
                else{
                    $('#cont-msg-form').fadeIn();
                    $('#msg-form-prod').text('Los campos obligatorios (*) no deben estar vacíos.');

                    setTimeout(function(){
                        $('#cont-msg-form').fadeOut();
                    }, 3000);
                }      

            },

            //-->Método que se activa al hacer click en limpiar del form Producto
            limpiarFormProducto: function(){

                //llamada a función para reseteo a vacío del objeto producto
                    this.resetFormProducto();

            },

            //-->Método que se activa al hace click en boton guardar productos
            guardarVariosProductos: function(){

                //token para ajax
                var token = $('#token_varios').val();

                var arrayProds = [];

                $('#seleccionar-varios').attr('disabled','disabled');
                $('#numberCuantos').val('1');
                this.seleccionarActivate==false;


                //si productosArray es mayor que cero
                if(this.productosArray.length>0){
                    //pasando a un array normal
                    for (var i = 0; i < this.productosArray.length; i++) {
                        arrayProds[i] = this.productosArray[i];
                    }

                    //ajax que envía a traves de post todos los productos al server
                    $.ajax({
                        headers: {'X-CSRF-Token':token},
                        url: "{{ url('/ajax/guardar/varios/productos') }}",
                        data: {productos:app.productosArray},
                        type: 'post',
                        dataType: 'json',
                        beforeSend: function(){
                            //se deshabilita el boton guardar productos
                            $('#btn_guardar_varios').attr('disabled','disabled');
                            //se oculta el boton
                            $('#btn_guardar_varios').hide();
                            //se muestra el load circle
                            $('#load_guardar_varios').show();
                            //ademas se muestra un mensaje de espera
                            $('#msg_guardar_varios').text('Guardando Productos ...')

                        },
                        success: function(data){
                            //retirna la data satisfacible
                            if(data==1){

                                //se oculta el load circle
                                $('#load_guardar_varios').hide();
                                //se muestra un mensaje de que los productos ya se guardaron
                                $('#msg_guardar_varios').text('Los Productos se han guardado satisfactoriamente.')

                                //temporizador de 1 seg.
                                setTimeout(function(){

                                    //se borra el mensaje último
                                    $('#msg_guardar_varios').text('');
                                    //se habilita nuevamente el boton guardar productos
                                    $('#btn_guardar_varios').removeAttr('disabled');
                                    //se muestra el boton
                                    $('#btn_guardar_varios').show();
                                    
                                    //automaticamente salta al sector de la lista de productos
                                    app.mostrarSectorProductos();

                                    //valor que hace que la tabla de varios productos vuelva a su estado inicial
                                    app.mostrarAgregarProductosItem=true;

                                    //el valor de cantidad de productos vuelve a cero
                                    app.agregar = 0;
                                    //los arrays de productos se resetean
                                    app.productosArray = [];
                                    app.productosVarios = [];

                                }, 1000);

                                
                            }
                            
                        }
                    })
                }

                //caso contrario
                else{
                    //muestra mensaje de aviso
                    $('#msg_auxiliar').fadeIn();
                    $('#msg_auxiliar').css({'margin-bottom':'1em','color':'red'});
                    $('#msg_auxiliar').text('Tienes que agregar productos.');

                    //temporizador para ocultar mensaje despues de 3seg.
                    setTimeout(function(){
                        $('#msg_auxiliar').fadeOut();
                        $('#msg_auxiliar').css({'margin-bottom':'0px'});
                        $('#msg_auxiliar').text('');
                    }, 3000);
                }
                

                
            },

            seleccionarClick: function(){
                $('#eliminar-varios').attr('disabled','disabled');

                if(this.seleccionarActivate==false){
                    this.seleccionarActivate = true;
                    $('#btn_guardar_varios').attr('disabled','disabled');
                }else{
                    this.seleccionarActivate = false;
                    $('#btn_guardar_varios').removeAttr('disabled');
                    
                }
                
            },

            clickCheck: function(elemento){
                cont=0;
                $('.checky').each(function(){ 
                    if($(this).is(':checked')){
                        cont=cont+1;
                    }else{
                        cont=cont+0;
                    }
                });

                if(cont>0){
                    $(elemento).removeAttr('disabled');
                }else{
                    $(elemento).attr('disabled','disabled');
                }
            },

            eliminarClick: function(){
                cont=0;
                var array = [];
                var array2 = [];
                var arrayFinal = [];
                var arrayFinal2 = [];

                array = this.productosArray;
                array2 = this.productosVarios;

                $('.checky').each(function(){ 
                    if($(this).is(':checked')){
                        delete array[cont];
                        delete array2[cont];
                        
                    }

                    cont=cont+1;
                });

                $('.checky').prop('checked',false);
                $('#eliminar-varios').attr('disabled','disabled');
                $('#btn_guardar_varios').removeAttr('disabled');
                this.seleccionarActivate = false;

                for(var i = 0; i < array.length; i++){
                    if(array[i]!=null){
                        arrayFinal.push(array[i]);
                    }

                    if(array2[i]!=null){
                        arrayFinal2.push(array2[i]);
                    }
                }
                this.agregar = arrayFinal.length;

                if(this.agregar==0){
                    this.mostrarAgregarProductosItem = true;
                    $('#seleccionar-varios').attr('disabled','disabled');
                }

                this.productosArray = arrayFinal;
                this.productosVarios = arrayFinal2;


            },

            keyGenerateCode: function(){
                this.producto.codigo = this.generateCodeProducto(this.producto.producto);
            },

            clickAgregarProductoVenta: function(){
                this.productoVenta.producto=$('#provider-json').val();
                this.venta.doc = $('#provider-json2').val();

                if(this.productoVenta.cantidad!=""&&this.productoVenta.producto!=""){
                    console.log(this.productoVenta.cantidad);
                    console.log(app.stocksito);
                    if(parseFloat(app.productoVenta.cantidad) <= parseFloat(app.stocksito)){
                        app.messageErrorStock = false;
                        this.mostrarAgregarProductosItem = false;
                        this.itemsVenta.push({
                            id: this.productoVenta.id,
                            producto: this.productoVenta.producto,
                            cantidad: this.productoVenta.cantidad,
                            pVenta : this.productoVenta.pVenta,
                            monto: parseFloat(this.productoVenta.cantidad) * parseFloat(this.productoVenta.pVenta)
                        });

                        this.totalVenta = parseFloat(this.totalVenta) + ( parseFloat(this.productoVenta.cantidad) * parseFloat(this.productoVenta.pVenta) );

                        $('#provider-json').val('');
                        this.productoVenta.cantidad="1";
                        this.productoVenta.producto="";
                        this.productoVenta.pVenta="";
                        app.stocksito = 0;
                    }else{
                        app.messageErrorStock = true;

                        setTimeout( function(){
                            app.messageErrorStock = false;
                        }, 2000);
                    }
                    
                }else{
                    app.messageErrorVacioVenta = true;

                    setTimeout( function(){
                        app.messageErrorVacioVenta = false;
                    }, 2000);
                }
            },

            onClickGuardarVenta: function(){
                var token = $('#token_venta').val();
                app.venta.monto = app.totalVenta;
                $.ajax({
                    headers: {'X-CSRF-Token':token},
                    url: "{{ url('/ajax/guardar/venta') }}/{{ $almacen->id }}",
                    data: {venta:app.venta,items:app.itemsVenta, consumo:app.consumo},
                    type: 'post',
                    dataType: 'json',
                    
                    success: function(data){
                        console.log(data);
                        if(data==1){
                            app.mostrarSectorVentas();
                            app.itemsVenta = [];
                            app.mostrarAgregarProductosItem = true;
                            app.totalVenta = 0.00;
                            app.venta.doc = "";
                            app.venta.cliente = "";
                        }
                    }
                });
            },

            onClickVerProductosEnVenta: function(id){
                app.tablaVentas = 2;

                $.ajax({
                    url: "{{ url('ajax/get/venta') }}/"+id,
                    type: "GET",
                    dataType: 'JSON',
                    success: function(data){
                        console.log(data);
                        app.verVenta = {
                            doc: data.documento,
                            cliente: data.cliente,
                            items: data.productos,
                            monto: data.monto,
                            tipo: data.tipo,
                            created_at: data.created_at,
                            updated_at: data.updated_at

                        }
                    }
                })
            },

            volverSectorVentas: function(){
                this.tablaVentas = 1;
            },

            onChangeVentaDia: function(){
                this.tablaVentas = 4;
                var fecha = app.ventaDia;
                var anio = fecha.substr(0,4);
                var mes = fecha.substr(5,2);
                var dia = fecha.substr(8,10);

                console.log(dia+"-"+mes+"-"+anio);

                $('#dateDia').text(dia+"-"+mes+"-"+anio);

                $.ajax({
                    url: '{{ url("ajax/obtener/total/ventas/dia") }}/'+app.ventaDia+'/{{ $sucursal->id }}',
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#totalVentasDia').html("<img src='{{ url('img/loading.GIF') }}' style='width:20px'>");
                        
                    },    
                    success: function(data){
                        $('#totalVentasDia').html('');
                        $('#totalVentasDia').html('<b>S/. '+data+'</b>');
                    }
                });
                               
                setTimeout(function(){
                    $('#table-ventas-dia').DataTable({
                        "ajax": '{{ url("ajax/obtener/ventas/dia") }}/'+app.ventaDia+'/{{ $sucursal->id }}',
                        "columns": [
                            { "data": "check" },
                            { "data": "numero" },
                            { "data": "created_at" },
                            { "data": "tipo" },
                            { "data": "documento" },

                            { "data": "cliente" },
                            { "data": "productos" },
                            { "data": "monto"},
                            
                            { "data": "updated_at" },
                            { "data": "opciones" },
                        ],
                        "order": [[ 1, "desc" ]],
                        "pageLength": 10, 
                        "language":{
                            "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                            "lengthMenu":"Mostrar _MENU_ Ventas",
                            "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Ventas",
                            "paginate": {
                                "first":"Primero",
                                "last":"Último",
                                "next":"Siguiente",
                                "previous":"Anterior"
                            },
                            "search":"Buscar:",
                            "emptyTable": "No Hay Ventas Registradas el dia "+dia+"-"+mes+"-"+anio,
                        },
                        "destroy":true
                    });
                }, 100);
            },

            onClickVentaDelDia: function(){
                this.tablaVentas = 3;

                $.ajax({
                    url: '{{ url("ajax/obtener/total/ventas/hoy") }}/{{ $sucursal->id }}',
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#totalVentasHoy').html("<img src='{{ url('img/loading.GIF') }}' style='width:20px'>");
                        
                    },    
                    success: function(data){
                        $('#totalVentasHoy').html('');
                        $('#totalVentasHoy').html('<b>S/. '+data+'</b>');
                    }
                });

                setTimeout(function(){
                    $('#table-ventas-hoy').DataTable({
                        "ajax": '{{ url("ajax/obtener/ventas/hoy") }}/{{ $sucursal->id }}',
                        "columns": [
                            { "data": "check" },
                            { "data": "numero" },
                            { "data": "created_at" },
                            { "data": "tipo" },
                            { "data": "documento" },

                            { "data": "cliente" },
                            { "data": "productos" },
                            { "data": "monto"},
                            
                            { "data": "updated_at" },
                            { "data": "opciones" },
                        ],
                        "order": [[ 1, "desc" ]],
                        "pageLength": 10, 
                        "language":{
                            "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                            "lengthMenu":"Mostrar _MENU_ Ventas",
                            "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Ventas",
                            "paginate": {
                                "first":"Primero",
                                "last":"Último",
                                "next":"Siguiente",
                                "previous":"Anterior"
                            },
                            "search":"Buscar:",
                            "emptyTable": "No Hay Ventas Registradas Hoy.",
                        },
                        "destroy":true
                    });
                }, 100);

                
            },

            //===========>Inventarios <============//
            mostrarSectorHacerInventario: function(){
                $('.home-sector-right_menu>.nav-pills>li>#hacer-inventario').css({
                        'border-radius': '0px',
                        'padding': '8px 10px 5px 10px',
                        'margin-bottom': '1px',
                        'border-bottom': '3px solid #e67e22',
                        'color': '#000',
                        'background-color': '#eee'
                    });

                $('.home-sector-right_menu>.nav-pills>li>#lista-inventarios').removeAttr('style');
                
                app.mostrarSectorHacerInventarioItem = false;

                $.ajax({
                    url: '{{ url('ajax/obtener/todos/inventarios') }}/{{ $sucursal->id }}',
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data){
                        //hoy
                        var date = new Date();
                        if(date.getMonth()+1<10){
                            var mes = "0"+(date.getMonth()+1);
                        }
                        if(date.getDate()<10){
                            var dia = "0"+date.getDate();
                        }

                        var fecha = date.getFullYear()+"-"+mes+"-"+dia;
                        var ban=0;
                        var ban2=0;
                        for (var i = 0; i < data.length; i++) {
                            if(fecha<=data[i]['fecha_fin']){
                                ban=1;
                            }

                            if(data[i]['tipo']==1){
                                ban2=1;
                            }
                        }

                        if(ban==1){
                            app.mostrarSectorMensajeNoInventarioItem = true;

                        }else{
                            app.mostrarSectorHacerInventarioItem = true;
                        }

                        if(ban2==1){
                            app.tipoInventario = [
                                {id:2,nombre:"Inventario Mensual"},
                                {id:3,nombre:"Inventario Circunstancial"},
                                {id:4,nombre:"Inventario Anual"}
                            ]
                        }else{
                            app.tipoInventario = [
                                {id:1,nombre:"Inventario Inicial"},
                                {id:2,nombre:"Inventario Mensual"},
                                {id:3,nombre:"Inventario Circunstancial"},
                                {id:4,nombre:"Inventario Anual"}
                            ]
                        }
                    }
                });

               
                this.mostrarSectorInventariosItem = false;
                app.mostrarCrearInventario = true;
                app.mostrarSectorEliminarInv = false;
                
                app.productosInventario = [];
                app.agregar=0;
                
            },

            guardarProductosRealTime: function(){
                //token para ajax
                var token = $('#token_productos_inventario').val();

                var arrayProds = [];
                
                $('#btn_guardar_varios').attr('disabled','disabled');


                //si la cantidad de productosInventario es mayor que cero
                if(this.productosVariosInventario.length>0){
                    //pasando a un array normal
                    for (var i = 0; i < this.productosVariosInventario.length; i++) {
                        arrayProds[i] = this.productosVariosInventario[i];
                    }

                    //ajax que envía a traves de post todos los productos al server
                    $.ajax({
                        headers: {'X-CSRF-Token':token},
                        url: "{{ url('/ajax/guardar/inventario/varios/productos') }}/{{ $almacen->id }}",
                        data: {productos:app.productosVariosInventario,inv:app.idinv},
                        type: 'post',
                        dataType: 'json',
                        beforeSend: function(){
                            //se muestra un mensaje 
                            $('#message-real-time').text('Guardando ...');

                        },
                        success: function(data){
                            //retirna la data satisfacible
                            if(data==1){
                                //el arreglo productosVariosInventario vuelve a vacio.
                                app.productosVariosInventario = [];

                                $('#btn_guardar_varios').removeAttr('disabled');
                                //se muestra un mensaje de que los productos ya se guardaron
                                $('#message-real-time').text('Guardado con exito.')

                                //temporizador de 1 seg.
                                setTimeout(function(){
                                    $('#message-real-time').text('');
 
                                }, 2000);

                                
                            }
                            
                        }
                    })
                }
            },

            agregarProductoInventario: function(){

                //evalua los campos del formulario si no estan vacíos
                if(this.producto.producto!=""&&this.producto.codigo!=""&&this.producto.id_categoria!=""&&this.producto.cantidad!=""&&this.producto.id_unidad!=""){

                    var categoria;
                    var unidad;


                        //colocando un nuevo producto en el array para la base de datos
                        this.productosVariosInventario.push({
                            producto: this.producto.producto.toUpperCase(),
                            nombre_comercial: this.producto.nombre_comercial.toUpperCase(),
                            codigo: this.producto.codigo,
                            categoria: this.producto.id_categoria,
                            cantidad: this.producto.cantidad,
                            unidad: this.producto.id_unidad,
                            pUnitario: this.producto.pUnitario,
                            stock: this.producto.stock
                        });

                        //valor que hace el muestreo de agregar producto a la tabla
                        this.mostrarAgregarProductosInventario=2;

                        //valor que aumenta cuando se agrega un nuevo producto
                        this.agregar = this.agregar+1;

                        //obtiene el nombre de categoria
                        for (var i = 0; i < this.categorias.length; i++) {
                            if(this.categorias[i]['id']==this.producto.id_categoria){
                                categoria = this.categorias[i]['nombre'];
                            }
                        }

                        //obtiene la abreviatura de la unidad
                        for (var i = 0; i < this.unidades.length; i++) {
                            if(this.unidades[i]['id']==this.producto.id_unidad){
                                unidad = this.unidades[i]['abreviatura'];
                            }
                        }

                        //colocando un nuevo producto en el array de muestreo
                        this.productosInventario.push({
                            producto: this.producto.producto.toUpperCase(),
                            nombre_comercial: this.producto.nombre_comercial.toUpperCase(),
                            codigo: this.producto.codigo,
                            categoria: categoria,
                            cantidad: this.producto.cantidad,
                            unidad: unidad,
                            pUnitario: this.producto.pUnitario,
                            stock: this.producto.stock
                        });

                        setTimeout( function(){
                            app.guardarProductosRealTime();
                        }, 500);
                        

                        this.agregar = this.productosInventario.length;

                        if(this.agregar > 0){
                            $('#seleccionar-varios-inventario').removeAttr('disabled');
                        }else{
                            $('#seleccionar-varios-inventario').attr('disabled','disabled');
                        }

                        //llamada a función para reseteo a vacío del objeto producto
                        this.resetFormProducto();

                }

                //caso contrario si estan vacíos
                else{
                    $('#cont-msg-form').fadeIn();
                    $('#msg-form-prod').text('Los campos obligatorios (*) no deben estar vacíos.');

                    setTimeout(function(){
                        $('#cont-msg-form').fadeOut();
                    }, 3000);
                }      


                // if(this.producto.codigo==""||this.producto.producto==""||this.producto.id_categoria==""||this.producto.cantidad==""||this.producto.id_unidad==""||this.producto.id_categoria==""||this.producto.stock==""){
                //     console.log('esta vacio');
                // }
                // else{


                //     this.mostrarAgregarProductosInventario = false;
                //     this.productosInventario.push({
                //         producto: this.producto.producto,
                //         codigo: this.producto.codigo,
                //         nombre_comercial: this.producto.nombre_comercial,
                //         categoria: this.producto.categoria,
                //         cantidad: this.producto.cantidad,
                //         unidad: this.producto.unidad,
                //         pUnitario: this.producto.pUnitario,
                //         stock: this.producto.stock
                //     });

                //     this.agregar = this.productosInventario.length;

                //     if(this.agregar > 0){
                //         $('#seleccionar-varios-inventario').removeAttr('disabled');
                //     }else{
                //         $('#seleccionar-varios-inventario').attr('disabled','disabled');
                //     }

                //     this.resetFormProducto();

                // }
            },
            eliminarItemsInventario: function(){
                var cont = 0;
                var array = [];
                var arrayFinal = [];

                array = this.productosInventario;

                $('.checky').each(function(){ 
                    if($(this).is(':checked')){
                        
                        $.ajax({
                            url: "{{ url('ajax/eliminar/producto/inventario') }}/"+array[cont]['codigo'],
                            type: 'GET',
                            dataType: 'JSON',
                            success: function(data){
                                console.log(data);

                            }
                        });

                        delete array[cont];
                    }

                    cont=cont+1;
                });

                $('.checky').prop('checked',false);
                $('#eliminar-varios-inventario').attr('disabled','disabled');
                $('#btn_guardar_varios').removeAttr('disabled');
                this.seleccionarActivate = false;

                for(var i = 0; i < array.length; i++){
                    if(array[i]!=null){
                        arrayFinal.push(array[i]);
                    }
                }

                this.agregar = arrayFinal.length;

                if(this.agregar==0){
                    this.mostrarAgregarProductosInventario = 1;
                    $('#seleccionar-varios').attr('disabled','disabled');
                }

                console.log(arrayFinal);

                this.productosInventario = arrayFinal;
            },

            keyGenerateCodeEditarItemInv: function(){
                this.inventarioItemEditar.codigo = this.generateCodeProducto(this.inventarioItemEditar.producto);
            },

            onChangeUnidadItemEditInv: function(){
                
                $.ajax({
                    url:'/ajax/obtener/unidad/'+this.provUnidadInv,
                    type:'get',
                    success: function(data){
                        app.inventarioItemEditar.unidad = data['abreviatura'];
                        console.log(data);
                    }
                });
            },

            onChangeCategoriaItemEditInv: function(){
                console.log(app.provCategoriaInv);
                $.ajax({
                    url:'/ajax/obtener/categoria/'+app.provCategoriaInv,
                    type:'get',
                    success: function(data){
                        app.inventarioItemEditar.categoria = data['nombre_categoria'];
                        console.log(data);
                    }
                });
            },

            guardarCambiosEditarItemInv: function(){
                $('#btn_guardar_varios').removeAttr('disabled');
                var arreglo = {
                    cantidad:"",
                    categoria:"",
                    codigo:"",
                    nombre_comercial:"",
                    pUnitario:"",
                    producto:"",
                    stock:"",
                    unidad:""
                };
                this.mostrarAgregarProductosInventario = 2;
                for (var i = 0; i < this.productosInventario.length; i++) {
                    if(this.productosInventario[i]['codigo']==this.inventarioItemEditar.codigo){
                        this.productosInventario[i] = this.inventarioItemEditar;
                    }
                }

                arreglo.cantidad = this.inventarioItemEditar.cantidad;
                arreglo.categoria = this.provCategoriaInv;
                arreglo.codigo = this.inventarioItemEditar.codigo;
                arreglo.nombre_comercial = this.inventarioItemEditar.nombre_comercial;
                arreglo.pUnitario = this.inventarioItemEditar.pUnitario;
                arreglo.producto = this.inventarioItemEditar.producto;
                arreglo.stock = this.inventarioItemEditar.stock;
                arreglo.unidad = this.provUnidadInv;

                var token = $('#token_productos_inv').val();

                $.ajax({
                    url: '{{ url('ajax/guardar/producto/en/inventario') }}',
                    data: {data:arreglo,code:this.code},
                    headers: {'X-CSRF-Token':token},
                    type: 'POST',
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#message-real-time').text('Guardando ...');
                    },
                    success: function(data){
                        if(data==1){
                            $('#message-real-time').text('Guardado con exito.')

                            //temporizador de 1 seg.
                            setTimeout(function(){
                                $('#message-real-time').text('');
                                $('#seleccionar-varios-inventario').removeAttr('disabled');
                            }, 2000);
                        }
                    }
                })
            },

            cancelarEditarItemInv: function(){
                this.mostrarAgregarProductosInventario = 2;
                $('#btn_guardar_varios').removeAttr('disabled');
                $('#seleccionar-varios-inventario').removeAttr('disabled');
            },

            editarItemInventario: function(codigo){

                $.ajax({
                    url:"{{ url('ajax/obtener/categoria/unidad/por/code') }}/"+codigo,
                    type:'get',
                    dataType:'json',
                    success: function(data){
                        console.log(data);
                        app.provCategoriaInv = data['id_categoria_producto'];
                        app.provUnidadInv = data['id_unidad_medida'];

                        
                    }
                });

                $('#btn_guardar_varios').attr('disabled','disabled');
                $('#seleccionar-varios-inventario').attr('disabled','disabled');
                this.mostrarAgregarProductosInventario = 3;

                for (var i = 0; i < this.productosInventario.length; i++) {
                    if(this.productosInventario[i]['codigo']==codigo){
                        this.inventarioItemEditar = this.productosInventario[i];
                        this.code = this.productosInventario[i]['codigo'];
                    }
                }


            },

            eliminarItemInventario: function(codigo){
                console.log(this.productosInventario);
                var arr=[];

                for (var i = 0; i < this.productosInventario.length; i++) {
                    if(this.productosInventario[i]['codigo']==codigo){
                        delete this.productosInventario[i];
                    }else{
                        arr.push(this.productosInventario[i]);
                    }
                }

                this.productosInventario = arr;
                app.agregar = app.productosInventario.length;
                if(app.agregar==0){
                    this.mostrarAgregarProductosInventario = 1;
                    $('#btn_guardar_varios').attr('disabled','disabled');
                    $('#seleccionar-varios-inventario').attr('disabled','disabled');
                }
                
                        
                $.ajax({
                    url: "{{ url('ajax/eliminar/producto/inventario') }}/"+codigo,
                    type: 'GET',
                    dataType: 'JSON',
                    beforeSend: function(){
                        $('#message-real-time').text('Eliminando ...')
                    },
                    success: function(data){
                       if(data){
                            $('#message-real-time').text('El producto '+data['producto']+' ha sido Eliminando.')
                            
                            
                            setTimeout(function(){
                                $('#message-real-time').text('');


                                
                            }, 2000);
                       }         

                    }
                });

                

            
                
            },

            mostrarSectorInventarios: function(){
                this.mostrarSectorInventariosItem = true;
                this.mostrarSectorHacerInventarioItem = false;
                
                this.mostrarCrearInventario = false;
                app.mostrarSectorEliminarInv = false;
                app.mostrarSectorMensajeNoInventarioItem = false;

                $('.home-sector-right_menu>.nav-pills>li>#lista-inventarios').css({
                        'border-radius': '0px',
                        'padding': '8px 10px 5px 10px',
                        'margin-bottom': '1px',
                        'border-bottom': '3px solid #e67e22',
                        'color': '#000',
                        'background-color': '#eee'
                    });

                $('.home-sector-right_menu>.nav-pills>li>#hacer-inventario').removeAttr('style');

                
                app.productosInventario = [];
                
                app.agregar = 0;


                $('#table-inventarios').DataTable({
                    "ajax": '{{ url("ajax/obtener/inventarios") }}/{{$almacen->id}}',
                    "columns": [
                        { "data": "check" },
                        { "data": "numero" },
                        { "data": "tipo_inventario" },
                        { "data": "fecha_inicio" },
                        { "data": "fecha_fin" },
                        { "data": "created_at" },
                        { "data": "opciones" },
                    ],
                    "order": [[ 5, "desc" ]],
                    "pageLength": 10, 
                    "language":{
                        "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                        "lengthMenu":"Mostrar _MENU_ Inventarios",
                        "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Inventarios",
                        "paginate": {
                            "first":"Primero",
                            "last":"Último",
                            "next":"Siguiente",
                            "previous":"Anterior"
                        },
                        "search":"Buscar:",
                        "emptyTable": "No Hay Inventarios Registrados.",
                    },
                    "destroy":true
                });
            },

            crearInventario: function(){



                var token = $('#token_inventario').val();
                

                if(this.inventario.tipo!=""&&this.inventario.fechaInicio!=""&&this.inventario.fechaFinal!=""&&this.inventario.observacion!=""){
                    this.mostrarCrearInventario = false;
                    app.agregar=0;

                    // if(app.agregar==0){
                    //     app.mostrarAgregarProductosInventario = 1;
                    // }
                    //ajax para crear el inventario nuevo
                    $.ajax({
                        headers: {'X-CSRF-Token':token},
                        url: '{{url("ajax/crear/inventario")}}',
                        data: {'inventario':app.inventario},
                        type:'POST',
                        dataType:'JSON',
                        success: function(data){
                            if(data){
                                app.idinv = data['id'];

                                for (var i = 0; i < app.tipoInventarios.length; i++) {
                                    
                                    if(data['id_tipo_inventario']==app.tipoInventarios[i]['id']){
                                        $('#titulo-tipo').text(app.tipoInventarios[i]['nombre']);
                                    }
                                    
                                }
                                console.log(app.tipoInventarios);
                                // if(data['id_tipo_inventario']==1){
                                //     $('#titulo-tipo').text('INVENTARIO INICIAL');
                                // }else if(data['id_tipo_inventario']==2){
                                //     $('#titulo-tipo').text('INVENTARIO MENSUAL');
                                // }else if(data['id_tipo_inventario']==3){
                                //     $('#titulo-tipo').text('INVENTARIO CIRCUNSTANCIAL');
                                // }else{
                                //     $('#titulo-tipo').text('INVENTARIO ANUAL');
                                // }

                                $('#init').text("Inició: "+data['fecha_inicio']);
                                $('#finish').text("Termina: "+data['fecha_fin']);
                                
                                $('#btn_guardar_varios').attr('disabled','disabled');
                                
                            }
                            
                        }
                        
                    })
                }else{
                    console.log('nooo');
                }
            },
            guardarProductosInventario: function(){
                //token para ajax
                var token = $('#token_productos_inventario').val();

                var arrayProds = [];

                $('#seleccionar-varios').attr('disabled','disabled');
                $('#numberCuantos').val('1');
                this.seleccionarActivate==false;


                //si la cantidad de productosInventario es mayor que cero
                if(this.productosVariosInventario.length>0){
                    //pasando a un array normal
                    for (var i = 0; i < this.productosVariosInventario.length; i++) {
                        arrayProds[i] = this.productosVariosInventario[i];
                    }

                    //ajax que envía a traves de post todos los productos al server
                    $.ajax({
                        headers: {'X-CSRF-Token':token},
                        url: "{{ url('/ajax/guardar/varios/productos') }}/{{ $almacen->id }}",
                        data: {productos:app.productosVariosInventario},
                        type: 'post',
                        dataType: 'json',
                        beforeSend: function(){
                            //se deshabilita el boton guardar productos
                            $('#btn_guardar_varios').attr('disabled','disabled');
                            //se oculta el boton
                            $('#btn_guardar_varios').hide();
                            //se muestra el load circle
                            $('#load_guardar_varios').show();
                            //ademas se muestra un mensaje de espera
                            $('#msg_guardar_varios').text('Guardando Productos ...')

                        },
                        success: function(data){
                            //retirna la data satisfacible
                            if(data==1){

                                //se oculta el load circle
                                $('#load_guardar_varios').hide();
                                //se muestra un mensaje de que los productos ya se guardaron
                                $('#msg_guardar_varios').text('Los Productos se han guardado satisfactoriamente.')

                                //temporizador de 1 seg.
                                setTimeout(function(){

                                    //se borra el mensaje último
                                    $('#msg_guardar_varios').text('');
                                    //se habilita nuevamente el boton guardar productos
                                    $('#btn_guardar_varios').removeAttr('disabled');
                                    //se muestra el boton
                                    $('#btn_guardar_varios').show();
                                    
                                    //automaticamente salta al sector de la lista de productos
                                    app.mostrarSectorProductos();

                                    //el valor de cantidad de productos vuelve a cero
                                    app.agregar = 0;
                                    //los arrays de productos se resetean
                                    app.productosArray = [];
                                    app.productosVarios = [];

                                }, 1000);

                                
                            }
                            
                        }
                    })
                }

                //caso contrario
                else{
                    //muestra mensaje de aviso
                    $('#msg_auxiliar').fadeIn();
                    $('#msg_auxiliar').css({'margin-bottom':'1em','color':'red'});
                    $('#msg_auxiliar').text('Tienes que agregar productos.');

                    //temporizador para ocultar mensaje despues de 3seg.
                    setTimeout(function(){
                        $('#msg_auxiliar').fadeOut();
                        $('#msg_auxiliar').css({'margin-bottom':'0px'});
                        $('#msg_auxiliar').text('');
                    }, 3000);
                }
                

            },

            onClickTipoInventarioDetail: function(id_inventario){
                app.mostrarSectorHacerInventarioItem = true;
                app.mostrarSectorInventariosItem = false;
                app.mostrarCrearInventario = false;
                app.mostrarSectorEliminarInv = false;
                app.idinv = id_inventario;
                $('#titulo-tipo').text('');

                $.ajax({
                    url: '{{ url('ajax/get/inventario') }}/'+id_inventario,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data){
                        for (let i = 0; i < app.tipoInventarios.length; i++) {
                            if(app.tipoInventarios[i]['id']==data['id_tipo_inventario']){
                                $('#titulo-tipo').text(app.tipoInventarios[i]['nombre']);
                            }
                        }

                        $('#init').text("Inició: "+data['fecha_inicio']);
                        $('#finish').text("Termina: "+data['fecha_fin']);
                    }
                })
                

                $.ajax({
                    url:'{{ url('ajax/get/productos/inventario') }}/'+app.idinv,
                    type:'GET',
                    dataType:'JSON',
                    success: function(data){
                        
                        if(data.length>0){
                            app.agregar = data.length;
                            $('#seleccionar-varios-inventario').removeAttr('disabled','disabled');
                            app.mostrarAgregarProductosInventario = 2;
                            for (var i = 0; i < data.length; i++) {

                                for (var j = 0; j < app.unidades.length; j++) {
                                    if(data[i]['producto']['id_unidad_medida']==app.unidades[j]['id']){
                                        var und = app.unidades[j];
                                    }
                                }

                                for (var k = 0; k < app.categorias.length; k++) {
                                    if(data[i]['producto']['id_categoria_producto']==app.categorias[k]['id']){
                                        var cat = app.categorias[k];
                                    }
                                }
                                    
                                app.productosInventario.push({
                                    producto: data[i]['producto']['nombre'],
                                    codigo: data[i]['producto']['codigo'],
                                    nombre_comercial: data[i]['producto']['nombre_comercial'],
                                    categoria: cat['nombre'],
                                    cantidad: data[i]['producto']['cantidad_presentacion'],
                                    unidad: und['abreviatura'],
                                    pUnitario: data[i]['producto']['precio'],
                                    stock: data[i]['stock']
                                });
                                    
                                
                            }
                        }else{
                            app.mostrarAgregarProductosInventario = 1;
                        }

                        

                       // producto: this.producto.producto,
                //         codigo: this.producto.codigo,
                //         nombre_comercial: this.producto.nombre_comercial,
                //         categoria: this.producto.categoria,
                //         cantidad: this.producto.cantidad,
                //         unidad: this.producto.unidad,
                //         pUnitario: this.producto.pUnitario,
                //         stock: this.producto.stock
                    }
                })
            },
            onClickEliminarInventario: function(id_inventario){
                app.mostrarSectorInventariosItem = false;
                app.mostrarSectorEliminarInv = true;

                app.idinv = id_inventario;
                
                $.ajax({
                    url: '{{ url('ajax/get/inventario') }}/'+id_inventario,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data){
                       $.ajax({
                            url:'{{ url('ajax/get/productos/inventario') }}/'+id_inventario,
                            type:'GET',
                            dataType:'JSON',
                            success: function(data){
                                if(data.length==0){
                                    $('#prodInv').html('<div class="text-center"><i aria-hidden="true" class="fa fa-cubes" style="font-size: 5em; color: rgb(44, 62, 80);"></i><span style="font-size:5em">0</span></div><div class="text-center">No hay productos en este Inventario.</div>');
                                }else{
                                     $('#prodInv').html('<div class="text-center"><i aria-hidden="true" class="fa fa-cubes" style="font-size: 5em; color: rgb(44, 62, 80);"></i><span style="font-size:5em">'+data.length+'</span></div><div class="text-center">Este Inventario tiene <b>'+data.length+'</b> productos contabilizados.</div><br><div class="text-center"><span class="label label-danger" style="font-size:90%;font-weight:normal"><i class="fa fa-exclamation-triangle"></i>&nbsp;<b>ADVERTENCIA:</b> Si eliminas este Inventario, todos los productos contabilizados en él y todo su registro, automáticamente también serán eliminados.</span></div>');
                                }
                            }
                        });

                       if(data['tipo']==1){
                            app.inventarioAux.tipo = 'INVENTARIO INICIAL';
                        }else if(data['tipo']==2){
                            app.inventarioAux.tipo = 'INVENTARIO MENSUAL';
                        }else if(data['tipo']==3){
                            app.inventarioAux.tipo = 'INVENTARIO CIRCUNSTANCIAL';
                        }else{
                            app.inventarioAux.tipo = 'INVENTARIO ANUAL';
                        }

                        app.inventarioAux.fechaInicio = data['fecha_inicio'];
                        app.inventarioAux.fechaFinal = data['fecha_fin'];
                        app.inventarioAux.observacion = data['observacion'];
                        

                    }
                });

                
            },
            onClickCancelarEliminarInv: function(){
                app.mostrarSectorInventariosItem = true;
                app.mostrarSectorEliminarInv = false;
                app.mostrarSectorMensajeNoInventarioItem = false;

            },
            onClickEliminarDeTodasManeras: function(){
                $.ajax({
                    url: '{{ url('ajax/eliminar/inventario') }}/'+app.idinv,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function(data){
                        if(data==1){
                            app.mostrarSectorInventariosItem = true;
                            app.mostrarSectorEliminarInv = false;
                            app.mostrarSectorInventarios();
                        }
                    }
                });
            },
            //===========>Fin Inventarios<============//

            mostrarSectorAlmacen: function(){
                this.mostrarSectorAlmacenItem = true;
                this.mostrarSectorStockProductoItem = false;

                
                    $('#table-almacen').DataTable({
                        "ajax": '{{ url("ajax/obtener/productos/almacen/") }}/{{ $almacen->id }}',
                        "columns": [
                            { "data": "check" },
                            { "data": "numero" },
                            { "data": "codigo" },
                            { "data": "producto" },
                            { "data": "presentacion" },
                            { "data": "nombre_comercial" },
                            { "data": "categoria" },
                            { "data": "stock" },
                            { "data": "opciones" },
                        ],
                        "order": [[ 1, "desc" ]],
                        "pageLength": 10, 
                        "language":{
                            "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                            "lengthMenu":"Mostrar _MENU_ Productos",
                            "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Productos",
                            "paginate": {
                                "first":"Primero",
                                "last":"Último",
                                "next":"Siguiente",
                                "previous":"Anterior"
                            },
                            "search":"Buscar:",
                            "emptyTable": "No Hay Productos Registrados.",
                        },
                        "destroy":true
                    });
                

                
            },
            mostrarSectorStockProducto: function(){
                this.mostrarSectorAlmacenItem = false;
                this.mostrarSectorStockProductoItem = true;
                

                $('#table-kardex').DataTable({
                        "ajax": '{{ url("ajax/obtener/movimientos/almacen/") }}/{{ $almacen->id }}',
                        "columns": [
                            { "data": "check" },
                            { "data": "numero" },
                            { "data": "id_operacion" },
                            { "data": "created_at" },
                            
                            { "data": "detalle" },
                            { "data": "entidad" },
                            { "data": "producto" },
                            { "data": "saldo" },
                            { "data": "entrada" },
                            { "data": "salida" },
                            { "data": "stock" },
                            
                            { "data": "opciones" },
                        ],
                        "order": [[ 1, "desc" ]],
                        "pageLength": 10, 
                        "language":{
                            "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                            "lengthMenu":"Mostrar _MENU_ Movimientos",
                            "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Movimientos",
                            "paginate": {
                                "first":"Primero",
                                "last":"Último",
                                "next":"Siguiente",
                                "previous":"Anterior"
                            },
                            "search":"Buscar:",
                            "emptyTable": "No Hay Movimientos Registrados.",
                        },
                        "destroy":true
                    });
            },

            /*** Compras ***/
            onClickGuardarCompra: function(){

                app.compra.doc = $('#provider-json3').val();

                var token = $('#token_compra').val();
                
                $.ajax({
                    headers: {'X-CSRF-Token':token},
                    url: "{{ url('/ajax/guardar/compra') }}/{{ $almacen->id }}",
                    data: {compra:app.compra, items:app.itemsCompra},
                    type: 'post',
                    dataType: 'json',
                    
                    success: function(data){
                        if(data==1){
                            app.mostrarSectorCompras();
                        }
                    }
                });
            
            },

            clickAgregarProductoCompra: function(){
                this.mostrarAgregarProductosComprasItem = false;
                this.productoCompra.producto=$('#provider-json4').val();

                var monto = (parseFloat(app.productoCompra.cantidad)*parseFloat(app.productoCompra.pCompra)).toFixed(2);

                this.totalCompra = (parseFloat(this.totalCompra) + parseFloat(monto)).toFixed(2);
                this.compra.monto = this.totalCompra;

                app.itemsCompra.push({
                    id: app.productoCompra.id,
                    cantidad: app.productoCompra.cantidad,
                    producto: app.productoCompra.producto,
                    pCompra: app.productoCompra.pCompra,
                    monto: monto,
                });

                this.productoCompra.id = "";
                this.productoCompra.cantidad = "1";
                this.productoCompra.pCompra = "";
                $('#provider-json4').val("");


            },

            calcularPrecioCompra: function(){
                if(app.calcular.monto==""||app.calcular.cantidad==""){
                    app.calcular.pCompra = "0.00"
                }else{
                    var calc = parseFloat(app.calcular.monto) / parseFloat(app.calcular.cantidad);
                    app.calcular.pCompra = calc.toFixed(2);
                }
                
            },

            onClickAceptarCalculoPCompra: function(){
                app.productoCompra.pCompra = app.calcular.pCompra;
            },

            onClickComprasDelDia: function(){
                app.tablaCompras = 3;

                $('.table-compras-hoy').DataTable({
                    "ajax": '{{ url("ajax/obtener/compras/hoy") }}/{{ $sucursal->id }}',
                    "columns": [
                        { "data": "check" },
                        { "data": "numero" },
                        { "data": "created_at" },
                        { "data": "documento" },

                        { "data": "proveedor" },
                        { "data": "productos" },
                        { "data": "monto"},
                        
                        { "data": "updated_at" },
                        { "data": "opciones" },
                    ],
                    "order": [[ 1, "desc" ]],
                    "pageLength": 10, 
                    "language":{
                        "loadingRecords": "<img src='{{ url('img/loading.GIF') }}' style='width:30px'><div class='text-center'>Cargando...</div>",
                        "lengthMenu":"Mostrar _MENU_ Compras",
                        "info":"Mostrando _START_ hasta _END_ de _TOTAL_ Compras",
                        "paginate": {
                            "first":"Primero",
                            "last":"Último",
                            "next":"Siguiente",
                            "previous":"Anterior"
                        },
                        "search":"Buscar:",
                        "emptyTable": "No Hay Compras Registradas.",
                    },
                    "destroy":true
                });
            },

            volverSectorCompras: function(){
                app.tablaCompras = 1;
                app.mostrarSectorCompras();
            },

            onClickVentasDelDiaPanel: function(){
                this.mostrarSector = 1;
                this.mostrarSectorVentasItem = true;
                this.mostrarSectorHacerVentaItem = false;
                
                setTimeout(function(){
                    $('.home-sector-right_menu>.nav-pills>li>#ver-ventas').css({
                        'border-radius': '0px',
                        'padding': '8px 10px 5px 10px',
                        'margin-bottom': '1px',
                        'border-bottom': '3px solid #e67e22',
                        'color': '#000',
                        'background-color': '#eee'
                    });
                    $('.home-sector-right_menu>.nav-pills>li>#hacer-venta').removeAttr('style');
                }, 10);
                
                app.onClickVentaDelDia();
                
            }
        }
    }); 


    
</script>
@endsection
