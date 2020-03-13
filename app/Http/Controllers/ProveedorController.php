<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Proveedor;

class ProveedorController extends Controller
{
    public function obtenerProveedores($idEmpresa){
    	$proveedores = Proveedor::where('id_pertenencia_empresa_filtro','=',$idEmpresa)->get();
    	$data = [];
        $i=0;


        foreach ($proveedores as $proveedor) {

            if($proveedor->dni==0){
                $docDNI = "-";
            }else{
                $docDNI = $proveedor->dni;
            }

            if($proveedor->ruc==0){
                $docRUC = "-";
            }else{
                $docRUC = $proveedor->ruc;
            }

        	$data[$i] = [
                "check"=>"<input type='checkbox'>",
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> </button> ',
                "numero"=>$i+1,
                'dni'=>"<a href='#' style='color:#4b4b80'>".$docDNI."</a>",
                'ruc'=>"<a href='#' style='color:#4b4b80'>".$docRUC."</a>",
                "proveedor"=>"<a href='#' style='color:#4b4b80'>".$proveedor->nombre."</a>",
                
                "created_at"=>date_format($proveedor->created_at, 'Y-m-d H:i:s'),
                "updated_at"=>date_format($proveedor->updated_at, 'Y-m-d H:i:s')
                
            ];
            $i=$i+1;
        }

        return json_encode(["data"=>$data]);
    }

    public function allProveedores($idEmpresa){
    	$proveedores = Proveedor::where('id_pertenencia_empresa_filtro','=',$idEmpresa)->get();
    	return json_encode($proveedores);
    }
}
