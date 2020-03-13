<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
	public function example_form(){
		return view('create_example');
	}

    public function crear(Request $request){
    	\App\Example::create([
    		'contenido'=> $request['contenido']
    		]);
    }

    public function obtener(Request $request){
    	$data = file_get_contents("https://api.sunat.cloud/ruc/".$request->ruc);
    	return $data;
    }
}
