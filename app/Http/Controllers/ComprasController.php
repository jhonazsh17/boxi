<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Proveedor;
use App\Producto;
use App\Almacen;
use App\Sucursal;
use App\Compra;
use App\ProductoProveedor;
use App\Stock;
use App\Kardex;
use App\UnidadMedida;

class ComprasController extends Controller
{
	public function obtenerCompras($idSucursal){
        $compras = \App\Compra::where('id_pertenencia_sucursal_filtro','=',$idSucursal)->get();
        $data = [];
        $i=0;
        

        foreach ($compras as $compra) {
            $p = ProductoProveedor::where('id_compra','=',$compra->id)->first();
            $p1 = ProductoProveedor::where('id_compra','=',$compra->id)->get();
            $proveedor = Proveedor::find($p['id_proveedor']);

            // if(count($p1)==1){
            //     $text = "Item";
            // }else{
            //     $text = "Items";
            // }

            //evalua documento del proveedor
            if($proveedor['ruc']==0){
                
                $prvdr = $proveedor['dni']." | ".$proveedor['nombre'];
                
            }else{
                
                $prvdr = $proveedor['ruc']." | ".$proveedor['nombre'];
                
            }

            //evalua el tipo de documento de la compra
            if($compra->tipo_documento=="Boleta de Venta"){
                $tipo = "BV.";
            }else{
                $tipo = "F.";   
            }

            $data[$i] = [
                "check"=>"<input type='checkbox'>",
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> </button> ',
                "numero"=>$i+1,
                "id"=>$compra->id,
                'documento'=>"<a href='#' style='color:#4b4b80'>".$tipo." ".$compra->nro_documento."</a>",
                "proveedor"=>"<a href='#' style='color:#4b4b80'>".$prvdr."</a>",
                "productos"=>"<button class='btn btn-sad btn-xs' onclick='onClickVerProductos(".$compra->id.")'>"."Items"."</button>",
                "monto"=>"<b> S/. ".$compra->monto_compra."</b>",
                "created_at"=>date_format($compra->created_at, 'Y-m-d H:i:s'),
                "updated_at"=>date_format($compra->updated_at, 'Y-m-d H:i:s')
            ];
            $i=$i+1;
            $docCliente = "";

        }

        return json_encode(["data"=>$data]);
    }

    public function obtenerComprasHoy($idSucursal){
        $compras = \App\Compra::where('id_pertenencia_sucursal_filtro','=',$idSucursal)->where('created_at','LIKE', date('Y-m-d').'%')->get();
        $data = [];
        $i=0;
        

        foreach ($compras as $compra) {
            $p = ProductoProveedor::where('id_compra','=',$compra->id)->first();
            $p1 = ProductoProveedor::where('id_compra','=',$compra->id)->get();
            $proveedor = Proveedor::find($p['id_proveedor']);

            // if(count($p1)==1){
            //     $text = "Item";
            // }else{
            //     $text = "Items";
            // }

            //evalua documento del proveedor
            if($proveedor['ruc']==0){
                
                $prvdr = $proveedor['dni']." | ".$proveedor['nombre'];
                
            }else{
                
                $prvdr = $proveedor['ruc']." | ".$proveedor['nombre'];
                
            }

            //evalua el tipo de documento de la compra
            if($compra->tipo_documento=="Boleta de Venta"){
                $tipo = "BV.";
            }else{
                $tipo = "F.";   
            }

            $data[$i] = [
                "check"=>"<input type='checkbox'>",
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> </button> ',
                "numero"=>$i+1,
                "id"=>$compra->id,
                'documento'=>"<a href='#' style='color:#4b4b80'>".$tipo." ".$compra->nro_documento."</a>",
                "proveedor"=>"<a href='#' style='color:#4b4b80'>".$prvdr."</a>",
                "productos"=>"<button class='btn btn-sad btn-xs' onclick='onClickVerProductos(".$compra->id.")'>"."Items"."</button>",
                "monto"=>"<b> S/. ".$compra->monto_compra."</b>",
                "created_at"=>date_format($compra->created_at, 'Y-m-d H:i:s'),
                "updated_at"=>date_format($compra->updated_at, 'Y-m-d H:i:s')
            ];
            $i=$i+1;
            $docCliente = "";

        }

        return json_encode(["data"=>$data]);
    }

    public function obtenerComprasHoySincronice($idSucursal){
        $compras = \App\Compra::where('id_pertenencia_sucursal_filtro','=',$idSucursal)->where('created_at','LIKE', date('Y-m-d').'%')->get();
        $total = 0;

        foreach ($compras as $compra) {
            $total = $total + $compra->monto_compra;
        }

        return json_encode($total);
    }

    public function obtenerComprasMesSincronice($idSucursal){
        $compras = \App\Compra::where('id_pertenencia_sucursal_filtro','=',$idSucursal)->where('created_at','LIKE', date('Y-m').'%')->get();
        $total = 0;

        foreach ($compras as $compra) {
            $total = $total + $compra->monto_compra;
        }

        return json_encode($total);
    }

    public function save(Request $request, $id){
    	$almacen = Almacen::find($id);
        $sucursal = Sucursal::find($almacen->id_sucursal);

    	if(strlen($request->compra['doc'])==8){
            $dni=$request->compra['doc'];
            $pr = Proveedor::where('dni','=',$request->compra['doc'])->first();
            $ruc=0;
        }else{
            $dni=0;
            $pr = Proveedor::where('ruc','=',$request->compra['doc'])->first();
            $ruc=$request->compra['doc'];
        }


        if(!$pr){
            Proveedor::create([
                'dni'=>$dni,
                'ruc'=>$ruc,
                'nombre'=>$request->compra['proveedor'],
                'direccion'=>"---",
                'lugar'=>"---",
                'lugar_proveniencia'=>"----",
                'slug'=>str_slug($request->compra['proveedor']),
                'id_pertenencia_empresa_filtro'=>$sucursal->id_empresa,
            ]);
        }

    	

        $proveedorLast = Proveedor::all()->last();

    	Compra::create([
                'nro_compra'=>'0001',
                'tipo_documento'=>$request->compra['tipoDoc'],
                'nro_documento'=>$request->compra['nroDoc'],
                'monto_compra'=>$request->compra['monto'],
                'id_pertenencia_sucursal_filtro'=>$sucursal->id,
            ]);

        $compraLast = Compra::all()->last();

        foreach ($request->items as $item) {
            $stock = Stock::where('id_producto','=',$item['id'])->first();
                $stock_history = $stock->cantidad_en_stock;
                $stock->cantidad_en_stock = $stock->cantidad_en_stock + $item['cantidad'];
                $stock->save();


            ProductoProveedor::create([
                'precio'=>$item['pCompra'],
                'cantidad_comprada'=>$item['cantidad'],
                'submonto'=>$item['monto'],
                'id_producto'=>$item['id'],
                'id_proveedor'=>$proveedorLast->id,
                'id_compra'=>$compraLast->id
            ]);

            $producto = Producto::find($item['id']);

                    Kardex::create([
                        'detalle'=>'Compra',
                        'id_operacion_filtro'=>$compraLast->id,
                        'codigo_producto'=>$producto['codigo'],
                        'id_producto'=>$producto['id'],
                        'nombre_producto'=>$producto['codigo']." ".$producto['nombre']." ".$producto['cantidad_presentacion']." ".$this->getAbrevUnidad($producto['id_unidad_medida']),
                        'entidad'=> "Proveedor: ".$proveedorLast->nombre,
                        'saldo'=>$stock_history,
                        'entrada'=>'True',
                        'salida'=>'False',
                        'cantidad'=>$item['cantidad'],
                        'stock'=> $stock_history + $item['cantidad'],
                        'id_almacen'=>$id,  
                    ]);
        }

        return json_encode(1);
    }

    public function getAbrevUnidad($id){
        $unidad = UnidadMedida::find($id);
        return $unidad->abreviatura;
    }

    
}
