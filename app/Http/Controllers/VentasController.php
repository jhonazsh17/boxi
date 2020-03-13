<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;
use App\Venta;
use App\VentaProductos;
use App\Producto;
use App\UnidadMedida;
use App\Categoria;
use App\Stock;
use App\Kardex;
use App\Almacen;
use App\Sucursal;
use App\ProductoCliente; 

class VentasController extends Controller
{
    public function index(){
    	return view('ventas/ventas');
    }

    public function getStockProducto($id){
        $stock = Stock::where('id_producto','=',$id)->first();
        return json_encode($stock['cantidad_en_stock']);
    }

    public function obtenerVentas($idSucursal){
        $ventas = \App\Venta::where('id_pertenencia_sucursal_filtro','=',$idSucursal)->get();
        $data = [];
        $i=0;
        

        foreach ($ventas as $venta) {
            $p = ProductoCliente::where('id_venta','=',$venta->id)->first();
            $p1 = ProductoCliente::where('id_venta','=',$venta->id)->get();
            $cliente = Cliente::find($p['id_cliente']);

            if(count($p1)==1){
                $text = "Item";
            }else{
                $text = "Items";
            }

            //evalua documento del cliente
            if($cliente['ruc']==0){
                if($cliente['nombre']=="Venta Rápida"){
                    $clt = "Venta Rápida";
                }else{
                    $clt = $cliente['dni']." | ".$cliente['nombre'];
                }
                
            }else{
                if($cliente['nombre']=="Venta Rápida"){
                    $clt = "Venta Rápida";
                }else{
                    $clt = $cliente['ruc']." | ".$cliente['nombre'];
                }
                
            }

            //evalua el tipo de documento de la venta
            if($venta->tipo_documento=="Boleta de Venta"){
                $tipo = "BV.";
            }else if($venta->tipo_documento=="Sin Documento"){
                $tipo = "";
            }else{
                $tipo = "F.";   
            }

            $data[$i] = [
                "check"=>"<input type='checkbox'>",
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> </button> ',
                "numero"=>$i+1,
                "id"=>$venta->id,
                'tipo'=>"<a href='#' style='color:#5c71da'>".$venta->tipo_venta."</a>",
                'documento'=>"<a href='#' style='color:#4b4b80'>".$tipo." ".$venta->nro_documento."</a>",
                "cliente"=>"<a href='#' style='color:#4b4b80'>".$clt."</a>",
                "productos"=>"<button class='btn btn-sad btn-xs' onclick='onClickVerProductos(".$venta->id.")'>".count($p1)." ".$text."</button>",
                "monto"=>"<b> S/. ".$venta->monto_venta."</b>",
                "created_at"=>date_format($venta->created_at, 'Y-m-d H:i:s'),
                "updated_at"=>date_format($venta->updated_at, 'Y-m-d H:i:s')
            ];
            $i=$i+1;
            $docCliente = "";

        }

        return json_encode(["data"=>$data]);
    }

    public function obtenerVentasHoy($idSucursal){

        $ventas = \App\Venta::where('id_pertenencia_sucursal_filtro','=',$idSucursal)->where('created_at','LIKE', date('Y-m-d').'%')->get();
        $data = [];
        $i=0;
        

        foreach ($ventas as $venta) {
            $p = ProductoCliente::where('id_venta','=',$venta->id)->first();
            $p1 = ProductoCliente::where('id_venta','=',$venta->id)->get();
            $cliente = Cliente::find($p['id_cliente']);

            if(count($p1)==1){
                $text = "Item";
            }else{
                $text = "Items";
            }

            //evalua documento del cliente
            if($cliente['ruc']==0){
                if($cliente['nombre']=="Venta Rápida"){
                    $clt = "Venta Rápida";
                }else{
                    $clt = $cliente['dni']." | ".$cliente['nombre'];
                }
                
            }else{
                if($cliente['nombre']=="Venta Rápida"){
                    $clt = "Venta Rápida";
                }else{
                    $clt = $cliente['ruc']." | ".$cliente['nombre'];
                }
                
            }

            //evalua el tipo de documento de la venta
            if($venta->tipo_documento=="Boleta de Venta"){
                $tipo = "BV.";
            }else if($venta->tipo_documento=="Sin Documento"){
                $tipo = "";
            }else{
                $tipo = "F.";   
            }

            $data[$i] = [
                "check"=>"<input type='checkbox'>",
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> </button> ',
                "numero"=>$i+1,
                "id"=>$venta->id,
                'tipo'=>"<a href='#' style='color:#5c71da'>".$venta->tipo_venta."</a>",
                'documento'=>"<a href='#' style='color:#4b4b80'>".$tipo." ".$venta->nro_documento."</a>",
                "cliente"=>"<a href='#' style='color:#4b4b80'>".$clt."</a>",
                "productos"=>"<button class='btn btn-sad btn-xs' onclick='onClickVerProductos(".$venta->id.")'>".count($p1)." ".$text."</button>",
                "monto"=>"<b> S/. ".$venta->monto_venta."</b>",
                "created_at"=>date_format($venta->created_at, 'Y-m-d H:i:s'),
                "updated_at"=>date_format($venta->updated_at, 'Y-m-d H:i:s')
            ];
            $i=$i+1;
            $docCliente = "";

        }

        return json_encode(["data"=>$data]);
    }

    public function obtenerVentasHoySincronice($idSucursal){

        $ventas = \App\Venta::where('id_pertenencia_sucursal_filtro','=',$idSucursal)->where('created_at','LIKE', date('Y-m-d').'%')->get();
        
        $total = 0;

        foreach ($ventas as $venta) {
            $total = $total + $venta->monto_venta;
        }

        return json_encode($total);

    }

    public function obtenerVentasMesSincronice($idSucursal){

        $ventas = \App\Venta::where('id_pertenencia_sucursal_filtro','=',$idSucursal)->where('created_at','LIKE', date('Y-m').'%')->get();
        
        $total = 0;

        foreach ($ventas as $venta) {
            $total = $total + $venta->monto_venta;
        }

        return json_encode($total);

    }   

    public function obtenerVentasDia($date, $idSucursal){
        $ventas = \App\Venta::where('id_pertenencia_sucursal_filtro','=',$idSucursal)->where('created_at','LIKE', $date.'%')->get();
        $data = [];
        $i=0;
        

        foreach ($ventas as $venta) {
            $p = ProductoCliente::where('id_venta','=',$venta->id)->first();
            $p1 = ProductoCliente::where('id_venta','=',$venta->id)->get();
            $cliente = Cliente::find($p['id_cliente']);

            if(count($p1)==1){
                $text = "Item";
            }else{
                $text = "Items";
            }

            //evalua documento del cliente
            if($cliente['ruc']==0){
                if($cliente['nombre']=="Venta Rápida"){
                    $clt = "Venta Rápida";
                }else{
                    $clt = $cliente['dni']." | ".$cliente['nombre'];
                }
                
            }else{
                if($cliente['nombre']=="Venta Rápida"){
                    $clt = "Venta Rápida";
                }else{
                    $clt = $cliente['ruc']." | ".$cliente['nombre'];
                }
                
            }

            //evalua el tipo de documento de la venta
            if($venta->tipo_documento=="Boleta de Venta"){
                $tipo = "BV.";
            }else if($venta->tipo_documento=="Sin Documento"){
                $tipo = "";
            }else{
                $tipo = "F.";   
            }

            $data[$i] = [
                "check"=>"<input type='checkbox'>",
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> </button> ',
                "numero"=>$i+1,
                "id"=>$venta->id,
                'tipo'=>"<a href='#' style='color:#5c71da'>".$venta->tipo_venta."</a>",
                'documento'=>"<a href='#' style='color:#4b4b80'>".$tipo." ".$venta->nro_documento."</a>",
                "cliente"=>"<a href='#' style='color:#4b4b80'>".$clt."</a>",
                "productos"=>"<button class='btn btn-sad btn-xs' onclick='onClickVerProductos(".$venta->id.")'>".count($p1)." ".$text."</button>",
                "monto"=>"<b> S/. ".$venta->monto_venta."</b>",
                "created_at"=>date_format($venta->created_at, 'Y-m-d H:i:s'),
                "updated_at"=>date_format($venta->updated_at, 'Y-m-d H:i:s')
            ];
            $i=$i+1;
            $docCliente = "";

        }

        return json_encode(["data"=>$data]);
    }    

    public function obtenerTotalVentasDia($date, $idSucursal){
        $ventas = \App\Venta::where('id_pertenencia_sucursal_filtro','=',$idSucursal)->where('created_at','LIKE', $date.'%')->get();
        $suma = 0;
        foreach ($ventas as $venta) {
            $suma = $suma + $venta->monto_venta;
        }

        return json_encode($suma);
    } 

    public function obtenerTotalVentasHoy($idSucursal){
        $ventas = \App\Venta::where('id_pertenencia_sucursal_filtro','=',$idSucursal)->where('created_at','LIKE', date('Y-m-d').'%')->get();
        $suma = 0;
        foreach ($ventas as $venta) {
            $suma = $suma + $venta->monto_venta;
        }

        return json_encode($suma);
    }    

    public function save(Request $request, $id){

        $almacen = Almacen::find($id);
        $sucursal = Sucursal::find($almacen->id_sucursal);
       
    	if($request->consumo=='true'){
            if($request->venta['doc']!=""&&$request->venta['cliente']!=""){

                if(strlen($request->venta['doc'])==8){
                    $dni=$request->venta['doc'];
                    $clnte = Cliente::where('dni','=',$dni)->where('id_pertenencia_empresa_filtro','=',$sucursal->empresa['id'])->first();
                    $ruc=0;
                }else{
                    $dni=0;
                    $ruc=$request->venta['doc'];
                    $clnte = Cliente::where('ruc','=',$ruc)->where('id_pertenencia_empresa_filtro','=',$sucursal->empresa['id'])->first();
                }

                //evalua si cliente existe
                if(!$clnte){
                    Cliente::create([
                        'dni'=>$dni,
                        'ruc'=>$ruc,
                        'nombre'=>$request->venta['cliente'],
                        'slug'=>str_slug($request->venta['cliente']),
                        'id_pertenencia_empresa_filtro'=>$sucursal->id_empresa

                    ]);
                }

                $clienteNew = Cliente::all()->last();

                Venta::create([
                    'nro_venta'=>'0001',
                    'tipo_documento'=>$request->venta['tipoDoc'],
                    'nro_documento'=>$request->venta['nroDoc'],
                    'monto_venta'=>$request->venta['monto'],
                    'tipo_venta'=>$request->venta['tipo'],
                    'dias_vencimiento_credito'=>0,
                    'id_pertenencia_sucursal_filtro'=>$sucursal->id,
                ]);

                $ventaLast = Venta::all()->last();



                for($i=0; $i<count($request->items);$i++){
                    $stock = Stock::where('id_producto','=',$request->items[$i]['id'])->first();
                    $stock_history = $stock->cantidad_en_stock;
                    $stock->cantidad_en_stock = $stock->cantidad_en_stock - $request->items[$i]['cantidad'];
                    $stock->save();

                    ProductoCliente::create([
                        'id_producto'=>$request->items[$i]['id'],
                        'id_venta'=> $ventaLast->id,
                        'id_cliente'=> $clienteNew->id,
                        'precio'=>$request->items[$i]['pVenta'],
                        'cantidad_vendida'=>$request->items[$i]['cantidad'],
                        'submonto'=>$request->items[$i]['monto']
                    ]);

                    $producto = Producto::find($request->items[$i]['id']);

                        Kardex::create([
                            'detalle'=>'Venta',
                            'id_operacion_filtro'=>$ventaLast->id,
                            'codigo_producto'=>$producto['codigo'],
                            'id_producto'=>$producto['id'],
                            'nombre_producto'=>$producto['codigo']." ".$producto['nombre']." ".$producto['cantidad_presentacion']." ".$this->getAbrevUnidad($producto['id_unidad_medida']),
                            'entidad'=> "Cliente: ".$clienteNew->nombre,
                            'saldo'=>$stock_history,
                            'entrada'=>'False',
                            'salida'=>'True',
                            'cantidad'=>$request->items[$i]['cantidad'],
                            'stock'=> $stock_history - $request->items[$i]['cantidad'],
                            'id_almacen'=>$id,  
                        ]);
                }

                return json_encode(1);
            }else{
                    //evaluar cliente vacío
                    if($request->venta['cliente']==""&&$request->venta['doc']==""){
                        $c = Cliente::where('ruc','=',0)->where('dni','=',0)->where('nombre', '!=', 'CONSUMO PROPIO')->where('id_pertenencia_empresa_filtro','=',$sucursal->empresa['id'])->first();

                        if($c){
                            $idc = $c['id'];
                            $cliente_ult = $c;
                        }else{
                            Cliente::create([
                                'dni'=>0,
                                'ruc'=>0,
                                'nombre'=>'VENTA RÁPIDA',
                                'slug'=>str_slug('VENTA RÁPIDA'),
                                'id_pertenencia_empresa_filtro'=>$sucursal->id_empresa
                            ]);

                            $cliente_ult = Cliente::all()->last();
                            $idc = $cliente_ult['id'];
                        }
                        
                    }

                    Venta::create([
                        'nro_venta'=>'0001',
                        'tipo_documento'=>$request->venta['tipoDoc'],
                        'nro_documento'=>$request->venta['nroDoc'],
                        'monto_venta'=>$request->venta['monto'],
                        'tipo_venta'=>$request->venta['tipo'],
                        'dias_vencimiento_credito'=>0,
                        'id_pertenencia_sucursal_filtro'=>$sucursal->id,
                    ]);

                    $ventaLast = Venta::all()->last();

                    for($i=0; $i<count($request->items);$i++){
            
                        $stock = Stock::where('id_producto','=',$request->items[$i]['id'])->first();
                        $stock_history = $stock->cantidad_en_stock;
                        $stock->cantidad_en_stock = $stock->cantidad_en_stock - $request->items[$i]['cantidad'];
                        $stock->save();

                        ProductoCliente::create([
                            'id_producto'=>$request->items[$i]['id'],
                            'id_venta'=> $ventaLast->id,
                            'id_cliente'=> $idc,
                            'precio'=>$request->items[$i]['pVenta'],
                            'cantidad_vendida'=>$request->items[$i]['cantidad'],
                            'submonto'=>$request->items[$i]['monto']
                        ]);

                        $producto = Producto::find($request->items[$i]['id']);

                        Kardex::create([
                            'detalle'=>'Venta',
                            'id_operacion_filtro'=>$ventaLast->id,
                            'codigo_producto'=>$producto['codigo'],
                            'id_producto'=>$producto['id'],
                            'nombre_producto'=>$producto['codigo']." ".$producto['nombre']." ".$producto['cantidad_presentacion']." ".$this->getAbrevUnidad($producto['id_unidad_medida']),
                            'entidad'=> "Cliente: ".$cliente_ult->nombre,
                            'saldo'=>$stock_history,
                            'entrada'=>'False',
                            'salida'=>'True',
                            'cantidad'=>$request->items[$i]['cantidad'],
                            'stock'=> $stock_history - $request->items[$i]['cantidad'],
                            'id_almacen'=>$id,  
                        ]);

                    }

                    return json_encode(1);

                
                
            }

            

        }else{
            $clienteConsumoPropio = Cliente::where('ruc','=','00000000000')->orWhere('dni','=','00000000')->first();

            //evalua si cliente existe
            if(!$clienteConsumoPropio){
                $cte = 'CONSUMO PROPIO';
                Cliente::create([
                    'dni'=>'00000000',
                    'ruc'=>'00000000000',
                    'nombre'=>$cte,
                    'slug'=>str_slug($cte),
                    'id_pertenencia_empresa_filtro'=>$sucursal->id_empresa

                ]);

                $clienteConsumoPropio = Cliente::all()->last();
            }

            Venta::create([
                'nro_venta'=>'0000',
                'tipo_documento'=>'Sin Documento',
                'nro_documento'=>'0000000',
                'monto_venta'=>$request->venta['monto'],
                'tipo_venta'=>'Consumo Propio',
                'dias_vencimiento_credito'=>0,
                'id_pertenencia_sucursal_filtro'=>$sucursal->id,
            ]);

            $ventaLast = Venta::all()->last();



            for($i=0; $i<count($request->items);$i++){
                $stock = Stock::where('id_producto','=',$request->items[$i]['id'])->first();
                $stock_history = $stock->cantidad_en_stock;
                $stock->cantidad_en_stock = $stock->cantidad_en_stock - $request->items[$i]['cantidad'];
                $stock->save();

                ProductoCliente::create([
                    'id_producto'=>$request->items[$i]['id'],
                    'id_venta'=> $ventaLast->id,
                    'id_cliente'=> $clienteConsumoPropio->id,
                    'precio'=>$request->items[$i]['pVenta'],
                    'cantidad_vendida'=>$request->items[$i]['cantidad'],
                    'submonto'=>$request->items[$i]['monto']
                ]);

                $producto = Producto::find($request->items[$i]['id']);

                Kardex::create([
                    'detalle'=>'Venta',
                    'id_operacion_filtro'=>$ventaLast->id,
                    'codigo_producto'=>$producto['codigo'],
                    'id_producto'=>$producto['id'],
                    'nombre_producto'=>$producto['codigo']." ".$producto['nombre']." ".$producto['cantidad_presentacion']." ".$this->getAbrevUnidad($producto['id_unidad_medida']),
                    'entidad'=> "Cliente: ".$clienteConsumoPropio->nombre,
                    'saldo'=>$stock_history,
                    'entrada'=>'False',
                    'salida'=>'True',
                    'cantidad'=>$request->items[$i]['cantidad'],
                    'stock'=> $stock_history - $request->items[$i]['cantidad'],
                    'id_almacen'=>$id,  
                ]);
            }

            return json_encode(1);
            
        }


        
        
    	
    }

    public function getProducto($id){
        $producto = Producto::find($id);
        return $producto->codigo." ".$producto->producto;
    }

    public function getAbrevUnidad($id){
        $unidad = UnidadMedida::find($id);
        return $unidad->abreviatura;
    }

    public function obtenerVenta($id){
        $venta = Venta::find($id);
        $itemGetCliente = \App\ProductoCliente::where('id_venta','=',$id)->first();
        $items = \App\ProductoCliente::where('id_venta','=',$id)->get();
        $cliente = \App\Cliente::find($itemGetCliente['id_cliente']);

        $arreglo_productos = [];
        $i=0;

        foreach ($items as $item) {
            $producto = Producto::find($item->id_producto);
            $unidad = UnidadMedida::find($producto->id_unidad_medida);
            $categoria = Categoria::find($producto->id_categoria_producto);
            $arreglo_productos[$i] = [
                'nombre' => $producto->nombre,
                'cantidad_presentacion' => $producto->cantidad_presentacion,
                'unidad'=>$unidad->abreviatura, 
                'precio'=>$item->precio,
                'cantidad'=>$item->cantidad_vendida,
                'submonto'=>$item->submonto
            ];
            $i=$i+1;
        }

        if($cliente['ruc']==0){
            if($cliente['nombre']=="Venta Rápida"){
                $clt = "Venta Rápida";
            }else{
                $clt = $cliente['dni']." | ".$cliente['nombre'];
            }
            
        }else{
            if($cliente['nombre']=="Venta Rápida"){
                $clt = "Venta Rápida";
            }else{
                $clt = $cliente['ruc']." | ".$cliente['nombre'];
            }
            
        }

        if($venta->tipo_documento=="Boleta de Venta"){
                $tipo = "BV.";
            }else if($venta->tipo_documento=="Sin Documento"){
                $tipo = "";
            }else{
                $tipo = "F.";   
            }


        $arreglo = [
            'documento'=>$tipo." ".$venta->nro_documento,
            'cliente'=>$clt,
            'monto'=>$venta->monto_venta,
            'tipo'=>$venta->tipo_venta,
            'productos'=> $arreglo_productos,
            'created_at'=>$venta->created_at->format('Y-m-d H:i:s'),
            'updated_at'=>$venta->updated_at->format('Y-m-d H:i:s')
        ];
        return json_encode($arreglo);
    }

}
