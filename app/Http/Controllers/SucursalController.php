<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Sucursal;
use App\Almacen;

class SucursalController extends Controller
{
    public function ajaxSave(Request $request, $id){
    	Sucursal::create([
    		'id_empresa'=>$id,
    		'nombre_sucursal'=>$request->nombre,
    		'lugar'=>$request->lugar,
    		'direccion'=>$request->direccion,
    		'descripcion'=>$request->descripcion,
            'serie'=>$request->serie,
    		'slug'=>str_slug($request->nombre)
    	]);

        $sucursal = Sucursal::all()->last();

        Almacen::create([
            'id_sucursal'=>$sucursal->id,
            'nombre'=>$request->nombre,
            'lugar'=>$request->lugar,
            'direccion'=>$request->direccion,
            'descripcion'=>$request->descripcion,
            'slug'=>str_slug($request->nombre)
        ]);

    	return json_encode(1);
    }

    public function ajaxSaveEditar(Request $request, $id, $idSucursal){
        $sucursal = Sucursal::find($idSucursal);
        $sucursal->nombre_sucursal = $request->nombre;
        $sucursal->lugar = $request->lugar;
        $sucursal->direccion = $request->direccion;
        $sucursal->descripcion = $request->descripcion;
        $sucursal->serie = $request->serie;
        $sucursal->slug = str_slug($request->nombre);
        $sucursal->save();

        $almacen = Almacen::where('id_sucursal', '=', $idSucursal)->first();
        $almacen->nombre = $request->nombre;
        $almacen->lugar = $request->lugar;
        $almacen->direccion = $request->direccion;
        $almacen->descripcion = $request->descripcion;
        $almacen->slug = str_slug($request->nombre);
        $almacen->save();

        return json_encode(1);
    }    

    public function all($id){
    	$sucursales = Sucursal::where('id_empresa','=',$id)->get();
    	$data = [];
    	$i=0;

    	foreach ($sucursales as $sucursal) {
    		$data[$i] = [
    			'numero'=>$i+1,
    			'nombre_sucursal'=>$sucursal->nombre_sucursal,
    			'lugar'=>$sucursal->lugar,
    			'direccion'=>$sucursal->direccion,
    			'created_at'=>date_format($sucursal->created_at, 'Y-m-d H:i:s'),
    			'opciones'=>'<button class="btn btn-default btn-xs" onclick="onClickEditarSucursal('.$sucursal->id.')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs" onclick="onClickEliminarSucursal('.$sucursal->id.')"><i class="fa fa-trash" aria-hidden="true"></i> </button>'
    		];

    		$i=$i+1;
    	}
    	return json_encode(["data"=>$data]);
    }

    public function all2($id){
        $sucursales = Sucursal::where('id_empresa','=',$id)->get();
        return json_encode($sucursales);
    }

    public function getSucursal($id){
        $sucursal = Sucursal::find($id);
        return json_encode($sucursal);
    }
}
