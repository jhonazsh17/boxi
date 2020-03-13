<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cargo;

class CargoController extends Controller
{
    public function getCargos($id){
    	
    	$cargos = Cargo::where('id_pertenencia_empresa_filtro','=',$id)->get();

    	$data = [];
        $i=0;

    	foreach ($cargos as $cargo) {
            
            $data[$i] = [
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs" ><i class="fa fa-trash" aria-hidden="true"></i> </button> ',
                "numero"=>$i+1,
                "cargo"=>"<a href='#' >".$cargo->nombre."</a>",
                "created_at"=>date_format($cargo->created_at, 'Y-m-d H:i:s')
                
            ];
            $i=$i+1;
        }

        return json_encode(["data"=>$data]);
    }

    public function ajaxSave(Request $request, $id){
    	Cargo::create([
    		'nombre'=>$request->nombre,
    		'id_pertenencia_empresa_filtro'=>$id,
    	]);

    	return json_encode(1);
    }

    public function ajaxGetCargos($id){
        $cargos = Cargo::where('id_pertenencia_empresa_filtro','=',$id)->get();
        return json_encode($cargos);
    }
}
