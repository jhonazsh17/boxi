<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Inventario;
use App\InventarioProducto;
use App\Producto;
use App\Stock;
use App\AlmacenProducto;
use App\Kardex;
use App\Categoria;
use App\UnidadMedida;
use App\Empresa;
use App\Almacen;

class InventarioController extends Controller
{
    /**
     * Función para crear un nuevo Inventario
     */
    public function crear(Request $request){

        //Método de clase para crear un nuevo registro inventario
        Inventario::create([
            'fecha_inicio'=>$request->inventario['fechaInicio'],
            'fecha_fin'=>$request->inventario['fechaFinal'],
            'observacion'=>$request->inventario['observacion'],
            'id_pertenencia_almacen_filtro'=>$request->inventario['id_pertenencia_almacen_filtro'],
            'id_tipo_inventario'=>$request->inventario['tipo']
        ]);
        
        //Consulta el último inventario registrado
        $inv = Inventario::all()->last();

        //retorna el último inventario registrado
        return json_encode($inv);

    }

    public function guardarProductos(Request $request, $id){
    	for ($i=0; $i < count($request->productos); $i++) { 
    		$producto = Producto::where('codigo','=',$request->productos[$i]['codigo'])->first();

    		if($producto){
    			$s = Stock::where('id_producto','=',$producto->id)->first();

    			$producto->codigo=$request->productos[$i]['codigo'];
	            $producto->nombre=$request->productos[$i]['producto'];
	            $producto->nombre_comercial=$request->productos[$i]['nombre_comercial'];
	            $producto->id_categoria_producto=$request->productos[$i]['categoria'];
	            $producto->cantidad_presentacion=$request->productos[$i]['cantidad'];
                $producto->id_unidad_medida=$request->productos[$i]['unidad'];
                $producto->slug = str_slug($request->productos[$i]['producto']);
	            $producto->precio=$request->productos[$i]['pUnitario'];
	            $producto->save();

	            $s->stock = $request->productos[$i]['stock'];
	            $s->save();



	            return json_encode(1);
    		}else{
    			Producto::create([
	                'codigo'=>$request->productos[$i]['codigo'],
	                'nombre'=>$request->productos[$i]['producto'],
	                'nombre_comercial'=>$request->productos[$i]['nombre_comercial'],
	                'id_categoria_producto'=>$request->productos[$i]['categoria'],
	                'cantidad_presentacion'=>$request->productos[$i]['cantidad'],
                    'id_unidad_medida'=>$request->productos[$i]['unidad'],
                    'slug'=> str_slug($request->productos[$i]['producto']),
	                'precio'=>$request->productos[$i]['pUnitario']
                ]);

    			$p = Producto::all()->last();

    			InventarioProducto::create([
                    'stock_historial'=> $request->productos[$i]['stock'],
    				'id_producto'=>$p->id,
    				'id_inventario'=>$request->inv    				
    			]);

                AlmacenProducto::create([
                    'id_almacen'=>$id,
                    'id_producto'=>$p->id
                ]);

                $almacen = Almacen::find($id);

                Kardex::create([
                    'detalle'=>'Inventario Inicial',
                    'id_operacion_filtro'=>$request->inv,
                    'codigo_producto'=>$request->productos[$i]['codigo'],
                    'id_producto'=>$p->id,
                    'nombre_producto'=>$request->productos[$i]['codigo']." ".$request->productos[$i]['producto']." ".$request->productos[$i]['cantidad']." ".$this->getAbrevUnidad($request->productos[$i]['unidad']),
                    'entidad'=> "Almacen: ".$almacen->nombre,
                    'saldo'=>$this->getSaldo($p->id),
                    'entrada'=>'True',
                    'salida'=>'False',
                    'cantidad'=>$request->productos[$i]['stock'],
                    'stock'=> $this->getSaldo($p->id) + $request->productos[$i]['stock'],
                    'id_almacen'=>$id, 
                ]);

                Stock::create([
                    'id_producto'=> $p->id,
                    'cantidad_en_stock'=>$request->productos[$i]['stock'],
                    'anterior_cantidad_en_stock'=>0
                ]);

                return json_encode(1);
    		}
            
        }
    }

    public function getNombreCategoria($id){
        $categoria = Categoria::find($id);
        return $categoria->nombre_categoria;
    }

    public function getAbrevUnidad($id){
        $unidad = UnidadMedida::find($id);
        return $unidad->abreviatura;
    }

    public function getSaldo($id){
        $stock = Stock::where('id_producto','=',$id)->first();
        if($stock){
            return $stock->cantidad_en_stock;
        }else{
            return 0;
        }
    }

    public function eliminarProductoInventario($codigo){
    	$producto = Producto::where('codigo','=',$codigo)->first();
        $aux = $producto;

    	$inventario = InventarioProducto::where('id_producto','=',$producto->id)->first();
    	$inventario->delete();

    	$stock = Stock::where('id_producto','=',$producto->id)->first();
    	$stock->delete();

    	$producto->delete();

        return json_encode($aux);
    }

    public function getCatUnidad($codigo){
        $producto = Producto::where('codigo','=', $codigo)->first();
        return json_encode($producto);
    }

    public function guardarProductoEnInventario(Request $request){
        $producto = Producto::where('codigo','=',$request->code)->first();
        $producto->codigo=$request->data['codigo'];
        $producto->nombre=$request->data['producto'];
        $producto->nombre_comercial=$request->data['nombre_comercial'];
        $producto->id_categoria_producto=$request->data['categoria'];
        $producto->cantidad_presentacion=$request->data['cantidad'];
        $producto->id_unidad_medida=$request->data['unidad'];
        $producto->precio=$request->data['pUnitario'];
        $producto->save();

        $s = Stock::where('id_producto','=',$producto->id)->first();
        $s->cantidad_en_stock = $request->data['stock'];
        $s->save();

        $i = InventarioProducto::where('id_producto','=',$producto->id)->first();
        $i->stock_historial = $request->data['stock'];
        $i->save();
        return json_encode(1);
    }

    /**
     * Función que devuelve la lista de todos los inventarios registrados para un almacen
     */
    public function getInventarios($id){
        //obtener todos los inventarios
        $inventarios = \App\Inventario::where('id_pertenencia_almacen_filtro','=',$id)->get();

        //arreglo "data" vacío
        $data = [];

        //indice
        $i=0;
        
        //bucle recorre la lista de inventarios
        foreach ($inventarios as $inventario) {

            $data[$i] = [
                "check"=>"<input type='checkbox'>",
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs" onclick="onClickEliminarInventario('.$inventario->id.')"><i class="fa fa-trash" aria-hidden="true"></i> </button> ',
                "numero"=>$i+1,
                "id"=>$inventario->id,
                "tipo_inventario"=>"<a href='#' onclick='onClickTipoInventarioDetail(".$inventario->id.")' style='color:#2980b9'>".$inventario->tipo_inventario->nombre."</a>",
                "fecha_inicio"=>$inventario->fecha_inicio,
                "fecha_fin"=>$inventario->fecha_fin,
                "created_at"=>date_format($inventario->created_at, 'Y-m-d H:i:s')
            ];

            $i=$i+1;
        }

        //retorna arreglo "data"
        return json_encode(["data"=>$data]);
    }

    public function getInventario($id){
        $inventario = Inventario::find($id);
        return $inventario;
    }

    public function getProductosInventario($id){
        $inventario = Inventario::find($id);
        $inventarioProductos = InventarioProducto::where('id_inventario','=',$id)->get();
        $productosArray = [];
        $i=0;

        foreach ($inventarioProductos as $inventarioProducto) {
            $productosArray[$i]['producto'] = Producto::find($inventarioProducto->id_producto);
            $productosArray[$i]['stock'] = $inventarioProducto->stock_historial;
            $i=$i+1;
        }

        return json_encode($productosArray);
    }
    public function eliminarInventario($id){
        $inventario = Inventario::find($id);
        $inventarios_reg = InventarioProducto::where('id_inventario','=',$id)->get();

        foreach ($inventarios_reg as $inventario_reg) {
            $id_p=$inventario_reg->id_producto;
            $stock = Stock::where('id_producto','=',$inventario_reg->id_producto)->first();
            $stock->delete();

            $inventario_reg->delete();

            $producto=Producto::find($id_p);
            $producto->delete();


        }

        $inventario->delete();

        return json_encode(1);
    }

    public function allInventarios($idSucursal){
        $almacen = Almacen::where('id_sucursal','=',$idSucursal)->first();
        $inventarios = Inventario::where('id_pertenencia_almacen_filtro','=',$almacen->id)->get();
        return json_encode($inventarios);
    }

    

}
