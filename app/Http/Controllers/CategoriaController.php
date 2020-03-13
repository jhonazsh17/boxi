<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Categoria;

class CategoriaController extends Controller
{
    public function crear(Request $request){
    	Categoria::create([
    	 	'nombre_categoria'=>$request['categoria']
    	 	]);

    	$categoria_ultimo = \App\Categoria::all()->last();
    	return $categoria_ultimo;
    }

    public function getCategoria($id){
    	$categoria = Categoria::find($id);
    	return $categoria;
    }

    public function getAllCategorias(){
        $categorias = Categoria::all();
        return json_encode($categorias);
    }

    public function getAllCategoriasForConfig($id){
        $categorias = Categoria::where('id_pertenencia_empresa_filtro', '=', $id)->get();
        
        $data = [];
        $i=0;

    	foreach ($categorias as $categoria) {
            
            $data[$i] = [
                "opciones"=>'<button class="btn btn-default btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs" ><i class="fa fa-trash" aria-hidden="true"></i> </button> ',
                "numero"=>$i+1,
                "categoria"=>"<a href='#' >".$categoria->nombre."</a>",
                "created_at"=>date_format($categoria->created_at, 'Y-m-d H:i:s')
            ];
            $i=$i+1;
        }

        return json_encode(["data"=>$data]);
    }

    public function guardarNuevaCategoriaForConfig(Request $request, $id){
        Categoria::create([
            'nombre' => $request['nombre'],
            'slug' => str_slug($request['nombre']),
            'id_pertenencia_empresa_filtro' => $id
            ]);

        return json_encode(1);
    }
}
