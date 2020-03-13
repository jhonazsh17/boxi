<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cliente;

class ClienteController extends Controller
{
    public function obtenerClientes($idEmpresa){
    	$clientes = Cliente::where('id_pertenencia_empresa_filtro','=',$idEmpresa)->get();
    	$data = [];
        $i=0;


        foreach ($clientes as $cliente) {

            if($cliente->dni==0){
                $docDNI = "-";
            }else{
                $docDNI = $cliente->dni;
            }

            if($cliente->ruc==0){
                $docRUC = "-";
            }else{
                $docRUC = $cliente->ruc;
            }

        	$data[$i] = [
                "check"=>"<input type='checkbox'>",
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs"><i class="fa fa-trash" aria-hidden="true"></i> </button> ',
                "numero"=>$i+1,
                'dni'=>"<a href='#' style='color:#4b4b80'>".$docDNI."</a>",
                'ruc'=>"<a href='#' style='color:#4b4b80'>".$docRUC."</a>",
                "cliente"=>"<a href='#' style='color:#4b4b80'>".$cliente->nombre."</a>",
                
                "created_at"=>date_format($cliente->created_at, 'Y-m-d H:i:s'),
                "updated_at"=>date_format($cliente->updated_at, 'Y-m-d H:i:s')
                
            ];
            $i=$i+1;
        }

        return json_encode(["data"=>$data]);
    }

    public function allClientes($idEmpresa){
    	$clientes = Cliente::where('id_pertenencia_empresa_filtro','=',$idEmpresa)->get();
    	return json_encode($clientes);
    }
}
