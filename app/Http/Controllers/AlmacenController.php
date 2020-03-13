<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AlmacenProducto;
use App\Producto;
use App\Categoria;
use App\UnidadMedida;
use App\Stock;
use App\Kardex;

class AlmacenController extends Controller
{
	public function getNombreCategoria($id){
        $categoria = Categoria::find($id);
        return $categoria->nombre;
    }

    public function getAbrevUnidad($id){
        $unidad = UnidadMedida::find($id);
        return $unidad->abreviatura;
    }

    public function getStock($id){
    	$stock = Stock::where('id_producto','=',$id)->first();
    	return $stock['cantidad_en_stock'];
    }

    public function getProductos($id){
    	$ps = AlmacenProducto::where('id_almacen','=',$id)->get();

    	$data=[];
    	$i=0;


    	foreach ($ps as $p) {
    		$producto=Producto::find($p->id_producto);

    		$data[$i] = [
                "check"=>"<input type='checkbox'>",
                "opciones"=>' <button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> </button>',
                "numero"=>$i+1,
                "id"=>$producto->id,
                "codigo"=>"<a href='#' style='color:#c0392b'><b>".$producto->codigo."</b></a>",
                "producto"=>"<a href='#' style='color:#2c3e50'>".$producto->nombre."</a>",
                "nombre_comercial"=>"<a href='#' style='color:#2c3e50'>".$producto->nombre_comercial."</a>",
                "categoria"=>$this->getNombreCategoria($producto->id_categoria_producto),
                "presentacion"=>$producto->cantidad_presentacion." ".$this->getAbrevUnidad($producto->id_unidad_medida),
                "created_at"=>date_format($producto->created_at, 'Y-m-d H:i:s'),
                "updated_at"=>date_format($producto->updated_at, 'Y-m-d H:i:s'),
                'stock'=>'<span class="badge">'.$this->getStock($producto->id).'</span>'
                
            ];
            $i=$i+1;
    	}

    	return json_encode(["data"=>$data]);
    }

    public function getMovimientos($id){

    	$movimientos = Kardex::where('id_almacen','=',$id)->get();

    	$data=[];
    	$i=0;


    	foreach ($movimientos as $movimiento) {
    		if($movimiento->salida=='True'){
    			$salida = "-".$movimiento->cantidad;
    		}else{
    			$salida = "-";
    		}

    		if($movimiento->entrada=='True'){
    			$entrada = "+".$movimiento->cantidad;
    		}else{
    			$entrada = "-";
    		}
    		
    		$data[$i] = [
                "check"=>"<input type='checkbox'>",
                "opciones"=>' <button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> </button>',
                "numero"=>$i+1,
                "id_operacion"=>'<a href="#" style="color:#2c3e50">'.$movimiento->id_operacion_filtro.'</a>',
                "detalle"=>$movimiento->detalle,
                "producto"=>$movimiento->nombre_producto,
                "entidad"=>$movimiento->entidad,
                "saldo"=>"<span style='color: #04ab04;font-weight: bold;'>".$movimiento->saldo."</span>",
                "salida"=>"<span style='color: #f10707;font-weight: bold;'>".$salida."</span>",
                'entrada'=>"<span style='color: #6161f1;font-weight: bold;'>".$entrada."</span>",
                'stock'=>"<span class='badge'>".$movimiento->stock."</span>",
                "created_at"=>date_format($movimiento->created_at, 'Y-m-d H:i:s')
                
                
            ];
            $i=$i+1;
    	}

    	return json_encode(["data"=>$data]);

    }
}
