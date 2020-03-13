<?php

namespace App\Classes;

use Illuminate\Support\Facades\Auth;

use App\Empleado;

Class UserServ{

	public $id_user;

	// public function __construct(){
	// }

	public function esEmpleado(){
		//$empleado = Empleado::where('id_user', $this->id_user)->get();

		return auth()->user();
		// if(count($empleado)!=0){
		// 	return "1";
		// }else{
		// 	return "2";
		// }
	}

}