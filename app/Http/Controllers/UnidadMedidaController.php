<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UnidadMedida;

class UnidadMedidaController extends Controller
{
    public function crear(Request $request){
    	\App\UnidadMedida::create([
    	 	'unidad'=>$request['unidad'],
    	 	'abreviatura'=>$request['abreviatura']
    	 	]);

    	$unidad_ultimo = \App\UnidadMedida::all()->last();
    	return $unidad_ultimo;
    }


    public function getUnidad($id){
    	$unidad = \App\UnidadMedida::find($id);
    	return $unidad;
    }

    public function getAllUnidades(){
        $unidades = UnidadMedida::all();
        return json_encode($unidades);
    }

    public function getAllUnidadesForConfig($id){
        $unidades = UnidadMedida::where('id_pertenencia_empresa_filtro', '=', $id)->get();
        
        $data = [];
        $i=0;

        foreach ($unidades as $unidad) {
            
            $data[$i] = [
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs" ><i class="fa fa-trash" aria-hidden="true"></i> </button> ',
                "numero"=>$i+1,
                "unidad"=>"<a href='#' >".$unidad->nombre."</a>",
                "abreviatura"=>"<a href='#' >".$unidad->abreviatura."</a>",
                "created_at"=>date_format($unidad->created_at, 'Y-m-d H:i:s')
            ];
            $i=$i+1;
        }

        return json_encode(["data"=>$data]);
    }

    public function guardarNuevaUnidadForConfig(Request $request, $id){
        UnidadMedida::create([
            'nombre' => $request['nombre'],
            'abreviatura' => $request['abreviatura'],
            'id_pertenencia_empresa_filtro' => $id
            ]);

        return json_encode(1);
    }
}
