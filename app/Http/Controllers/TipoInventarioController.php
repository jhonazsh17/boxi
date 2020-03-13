<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TipoInventario;

class TipoInventarioController extends Controller
{
    public function saveTipo($id, Request $request){
    	TipoInventario::create([
    		'nombre'=>$request->nombre,
    		'slug'=>str_slug($request->nombre),
    		'id_pertenencia_empresa_filtro'=>$id,
    	]);

    	return json_encode(1);
    }

    public function getTipo($id){
    	$tipos = TipoInventario::where('id_pertenencia_empresa_filtro','=',$id)->get();

    	$data = [];
        $i=0;

    	foreach ($tipos as $tipo) {
            
            $data[$i] = [
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs" ><i class="fa fa-trash" aria-hidden="true"></i> </button> ',
                "numero"=>$i+1,
                "tipo_inventario"=>"<a href='#' >".$tipo->nombre."</a>",
                "created_at"=>date_format($tipo->created_at, 'Y-m-d H:i:s')
                
            ];
            $i=$i+1;
        }

        return json_encode(["data"=>$data]);
    }

    public function getTipoInventario($id){
        $tipos = TipoInventario::where('id_pertenencia_empresa_filtro','=',$id)->get();
        return json_encode($tipos);
    }
}
