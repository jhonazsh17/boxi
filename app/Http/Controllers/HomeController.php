<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\View;
use App\Empresa;
use App\User;
use App\Sucursal;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = \App\Categoria::all();
        $unidades = \App\UnidadMedida::all();
        $productos = \App\Producto::all();
        return view('home',compact('categorias','unidades','productos'));
    }

    public function perfil(){

        $empleado = User::find(Auth::user()->id)->empleado;

        if($empleado){
            $sucursal = Sucursal::find($empleado->id_pertenencia_sucursal_filtro);
            $empresa = $sucursal->empresa;
            return view('dash.perfil-empleado', compact('empleado','empresa'));
        }else{
            return view('dash.perfil-administrador');
        }
        
    }

    /* => Función que muestra la vista de administración */
    public function administracion(){
        $empresas = User::find(Auth::id())->empresas;
        return view('dash.administracion', compact('empresas'));
    }
}
