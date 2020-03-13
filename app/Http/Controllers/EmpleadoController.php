<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Empresa;
use App\Empleado;
use App\User;
use App\Sucursal;
use App\Cargo;

use Hash;
use Auth;


class EmpleadoController extends Controller
{
    public function save(Request $request){
    	User::create([
    		'name' => $request->user['nombre'],
    		'email' => $request->user['email'],
    		'password' => bcrypt($request->user['password']),
		]);

  		$ulast = User::all()->last();

    	$empleado = Empleado::create([
    		'doc_identidad'=>$request->user['nro_documento'],
    		'tipo_documento'=>$request->user['tipo_documento'],
    		'direccion'=>$request->user['direccion'],
    		'genero'=>$request->user['genero'],
    		'id_pertenencia_sucursal_filtro'=>$request->user['sucursal_name'],
    		'id_user'=>$ulast->id,
    		'id_cargo_empleado'=>$request->user['cargo_name']
    	]);

    	if($empleado){
    		return json_encode(1);
    	}
    }

    public function ajaxGetUsuariosEmpleados($id){
    	$sucursales = Empresa::find($id)->sucursales;
    	$empleadosArray = [];
    	$i=0;
    	

    	foreach($sucursales as $sucursal){
    		$empleados = Empleado::where('id_pertenencia_sucursal_filtro', $sucursal->id)->get();

    		foreach ($empleados as $empleado) {
    			$user = User::find($empleado->id_user);
    			$cargo = Cargo::find($empleado->id_cargo_empleado);

    			$empleadosArray[$i] = [
    				"id"=>$empleado->id,
    				"doc_identidad"=>$empleado->doc_identidad,
    				"direccion"=>$empleado->direccion,
    				"genero"=>$empleado->genero,
    				"sucursal"=>$sucursal->nombre_sucursal,
    				"created_at"=>$empleado->created_at,
    				"updated_at"=>$empleado->updated_at,
    				"user_name"=>$user->name,
    				"user_email"=>$user->email,
    				"cargo"=>$cargo->nombre
    			];
    			$i=$i+1;
    		}
    	}

    	return $empleadosArray;
    }

    public function getDataUsuariosEmpleados($id){
    	$empleados = $this->ajaxGetUsuariosEmpleados($id);

    	$data = [];
    	$i=0;

    	foreach ($empleados as $empleado) {
    		$data[$i] = [
    			'numero'=>$i+1,
    			'usuario_empleado'=>$empleado['user_name'],
    			'documento'=>$empleado['doc_identidad'],
    			'email'=>$empleado['user_email'],
    			'cargo'=>$empleado['cargo'],
    			'sucursal'=>$empleado['sucursal'],
    			'created_at'=>date_format($empleado['created_at'], 'Y-m-d H:i:s'),
    			'opciones'=>'<button class="btn btn-default btn-xs" onclick="onClickEditarEmpleado('.$empleado['id'].')"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button> <button class="btn btn-sad btn-xs" onclick="onClickEliminarEmpleado('.$empleado['id'].')"><i class="fa fa-trash" aria-hidden="true"></i> </button>'
    		];

    		$i=$i+1;
    	}
    	return json_encode(["data"=>$data]);
    }

    public function getEmpleado($id){
    	$empleado = Empleado::find($id);
    	$user = User::find($empleado->id_user);
    	$cargo = Cargo::find($empleado->id_cargo_empleado);
    	$sucursal = Sucursal::find($empleado->id_pertenencia_sucursal_filtro);

    	$empleado_usuario = [
    		"id"=>$empleado->id,
    		"doc_identidad"=>$empleado->doc_identidad,
    		"tipo_documento"=>$empleado->tipo_documento,
    		"direccion"=>$empleado->direccion,
    		"genero"=>$empleado->genero,
    		"password"=> $this->passwordCorrect($user->password),
    		"sucursal"=>$sucursal->id,
    		"created_at"=>$empleado->created_at,
    		"updated_at"=>$empleado->updated_at,
    		"user_name"=>$user->name,
    		"user_email"=>$user->email,
    		"cargo"=>$cargo->id
    	];

    	return json_encode($empleado_usuario);
    }

    private function passwordCorrect($suppliedPassword)
	{
	    return Hash::check($suppliedPassword, Auth::user()->password, []);
	}
}
