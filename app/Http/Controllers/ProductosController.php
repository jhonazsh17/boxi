<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Categoria;
use App\UnidadMedida;
use App\Stock;
use App\AlmacenProducto;


class ProductosController extends Controller
{
    public function crear(Request $request){
    	\App\Producto::create([
    		'codigo'=>$request['codigo'],
    		'producto'=>$request['producto'],
    		'nombre_comercial'=>$request['nombre_comercial'],
    		'id_categoria'=>$request['id_categoria'],
    		'cantidad'=>$request['cantidad'],
    		'id_unidad'=>$request['id_unidad'],
            'precio'=>$request['pUnitario']
    		]);

    	$producto_ultimo = \App\Producto::all()->last();
    	return $producto_ultimo;
    }

    public function getNombreCategoria($id){
        $categoria = Categoria::find($id);
        return $categoria->nombre;
    }

    public function getAbrevUnidad($id){
        $unidad = UnidadMedida::find($id);
        return $unidad->abreviatura;
    }

    public function getProductos($idSucursal){

        $almacen = \App\Almacen::where('id_sucursal','=',$idSucursal)->first();
        $items = AlmacenProducto::where('id_almacen','=',$almacen->id)->get();

    	
        $data = [];
        $i=0;
        
        foreach ($items as $item) {

            $producto = \App\Producto::find($item->id_producto);
            
            $data[$i] = [
                "check"=>"<input type='checkbox'>",
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> </button> <button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>',
                "numero"=>$i+1,
                "id"=>$producto->id,
                "codigo"=>"<a href='#' style='color:#c0392b'><b>".$producto->codigo."</b></a>",
                "producto"=>"<a href='#' style='color:#2c3e50'>".$producto->nombre."</a>",
                "nombre_comercial"=>"<a href='#' style='color:#2c3e50'>".$producto->nombre_comercial."</a>",
                "categoria"=>$this->getNombreCategoria($producto->id_categoria_producto),
                "presentacion"=>$producto->cantidad_presentacion." ".$this->getAbrevUnidad($producto->id_unidad_medida),
                "created_at"=>date_format($producto->created_at, 'Y-m-d H:i:s'),
                "updated_at"=>date_format($producto->updated_at, 'Y-m-d H:i:s')
                
            ];
            $i=$i+1;
        }

    	return json_encode(["data"=>$data]);
    }

    public function ajaxGetAllProductos($idSucursal){
        $almacen = \App\Almacen::where('id_sucursal','=',$idSucursal)->first();
        $items = AlmacenProducto::where('id_almacen','=',$almacen->id)->get();

       
        $arrayProductos = [];
        $i=0;

        foreach ($items as $item) {
            $producto = \App\Producto::find($item->id_producto);

            $categoria = Categoria::find($producto->id_categoria_producto);
            $unidad = UnidadMedida::find($producto->id_unidad_medida);

            $stock = Stock::where('id_producto','=',$producto->id)->first();

            $arrayProductos[$i] = [
                'id'=>$producto->id,
                'producto'=>$producto->nombre,
                'precio'=>$producto->precio,
                'categoria'=>$categoria['nombre_categoria'],
                'cantidad'=>$producto['cantidad_presentacion'],
                'unidad'=>$unidad['abreviatura'],
                'stock'=>$stock['cantidad_en_stock']
            ];

            $i=$i+1;
        }

        return $arrayProductos;
    }

    public function crearProductos($id, Request $request){

        for ($i=0; $i < count($request->productos); $i++) { 

            \App\Producto::create([
                'codigo'=>$request->productos[$i]['codigo'],
                'producto'=>$request->productos[$i]['producto'],
                'nombre_comercial'=>$request->productos[$i]['nombre_comercial'],
                'id_categoria'=>$request->productos[$i]['categoria'],
                'cantidad'=>$request->productos[$i]['cantidad'],
                'id_unidad'=>$request->productos[$i]['unidad'],
                'precio'=>$request->productos[$i]['pUnitario']
                ]);
        }

        return json_encode(1);

    }

    
}
