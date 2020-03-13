<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use App\Empresa;
use App\Categoria;
use App\UnidadMedida;
use App\Producto;
use App\User;
use App\Sucursal;
use App\Almacen;
use App\TipoInventario;
use App\Cargo;
use App\Empleado;

class EmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /** 
     * => Función para mostrar la vista de crear Empresa. 
     */
    public function create(){
    	return view('dash.empresa.crear');
    }

    /**
     * => Función para guardar Empresa. 
     */
    public function save(Request $request){
        
        //Evalua los campos que son obligatorios
        if($request->ruc==""||$request->razon_social==""||$request->direccion==""||$request->pais=""||$request->departamento==""||$request->provincia==""||$request->distrito==""){
            return $this->redirectMessageValue('Los campos con asterisco son obligatorios.' , $request);
        }else{
            
            //evalua los digitos del ruc
            if(strlen($request->ruc)<11){
                return $this->redirectMessageValue('El RUC debe ser 11 numeros.' , $request);
            }else{

                //Recibe el archivo de imagen y se almacena en $logo
                $logo=$request->file('logo');

                //evalua si esta vacia la variable logo
                if($logo==""){
                    $l = "";
                }else{
                    $l = $logo->getClientOriginalName();
                    //Mover el archivo a la carpeta "/public/uploads/empresas/logo/"
                    $logo->move(base_path().'/public/uploads/empresas/logo/',$logo->getClientOriginalName());
                }

                $rucEvaluate = Empresa::where('ruc','=',$request->ruc)->first();

                //evalua si el ruc de la empresa ya se encuentra registrado
                if(!$rucEvaluate){

                    //Evaluamos la condición para asignar el slug
                    if($request->nombre_comercial==""){
                        $slug = str_slug($request->razon_social." ".$request->ruc);
                    }else{
                        $slug = str_slug($request->nombre_comercial." ".$request->ruc);
                    }

                    //Método de clase Empresa, para crear nueva empresa
                    Empresa::create([
                        'ruc'=>$request->ruc,
                        'razon_social'=>$request->razon_social,
                        'nombre_comercial'=>$request->nombre_comercial,
                        'direccion'=>$request->direccion,
                        'distrito'=>$request->distrito,
                        'provincia'=>$request->provincia,
                        'departamento'=>$request->departamento,
                        'pais'=>$request->pais,
                        'descripcion'=>$request->descripcion,
                        'vision'=>$request->vision,   
                        'mision'=>$request->mision,      
                        'slug'=>$slug,
                        'logo'=>$l,
                        'id_user'=>Auth::id()
                    ]);

                    //Retorna a la ruta /administracion
                    return redirect('/'.$slug.'/configuracion');
                }else{
                    return $this->redirectMessageValue('Este RUC: '.$request->ruc.' ya esta registrado.' , $request);
                }
            }
        }
        
    }

    public function redirectMessageValue($msg, $request){
        return redirect('/empresa/crear')
            ->with('msg', $msg)
            ->with('ruc', $request->ruc)
            ->with('razon_social', $request->razon_social)
            ->with('nombre_comercial', $request->nombre_comercial)
            ->with('direccion', $request->direccion)
            ->with('pais', $request->pais)
            ->with('departamento', $request->departamento)
            ->with('provincia', $request->provincia)
            ->with('distrito', $request->distrito)
            ->with('descripcion', $request->descripcion)
            ->with('mision', $request->mision)
            ->with('vision', $request->vision);
    }    

    /** 
     * => Función que muestra la vista donde estan las sucursales a administrar
     *    de la Empresa.
     */
    public function empresaDash($slug){
        //Consulta mediante slug la empresa
    	$empresa = Empresa::where('slug','=',$slug)->first();

        //Consulta las sucursales de la empresa
        $sucursales = Empresa::find($empresa->id)->sucursales;

        if($empresa->user['id']==Auth::user()->id){
            return view('dash.pre', compact('empresa','sucursales'));
        }else{
            return back()->withInput();
        }
        
    }

    /** 
     * => Función para editar Empresa.
     */
    public function empresaEdit(Request $request, $id){
        $empresa = Empresa::find($id);
        $empresa->razon_social = $request->empresa['razon_social'];
        $empresa->ruc = $request->empresa['ruc'];
        $empresa->nombre_comercial = $request->empresa['nombre_comercial'];
        $empresa->direccion = $request->empresa['direccion'];
        $empresa->departamento = $request->empresa['departamento'];
        $empresa->provincia = $request->empresa['provincia'];
        $empresa->distrito = $request->empresa['distrito'];
        $empresa->pais = $request->empresa['pais'];
        $empresa->descripcion = $request->empresa['descripcion'];
        $empresa->vision = $request->empresa['vision'];
        $empresa->mision = $request->empresa['mision'];

        if($request->empresa['nombre_comercial']==""){
            $empresa->slug = str_slug($request->empresa['razon_social']);
        }else{
            $empresa->slug = str_slug($request->empresa['nombre_comercial']);
        }

        $empresa->save();
        
        return json_encode(1);
        
    }

    public function empresaDashSuc($slug, $slugsuc){
        $empresa = Empresa::where('slug','=',$slug)->first();
        if($empresa->user['id']==Auth::user()->id){            
            $sucursal = Sucursal::where('slug','=',$slugsuc)->first();
            $almacen = Almacen::where('slug','=',$slugsuc)->first();
            $empresas = Empresa::where('id_user', '=', Auth::user()->id)->get();
            $categorias = Categoria::where('id_pertenencia_empresa_filtro', '=', $empresa->id)->get();
            $unidades = UnidadMedida::where('id_pertenencia_empresa_filtro', '=', $empresa->id)->get();
            $productos = Producto::all();
            $tiposInv = TipoInventario::where('id_pertenencia_empresa_filtro', '=', $empresa->id)->get();
            return view('home',compact('categorias','unidades','productos','empresa', 'empresas','sucursal','almacen', 'tiposInv'));
        }else{
            return back()->withInput();
        }
    	
    	
  		
    }


    public function empresaConfiguracion($slug){
        $empresa = Empresa::where('slug','=',$slug)->first();

        if($empresa->user['id']==Auth::user()->id){            
            $users = Empleado::all();
            $cargos = Cargo::where('id_pertenencia_empresa_filtro',$empresa->id)->get();
            $sucursales = Sucursal::where('id_empresa',$empresa->id)->get();
            return view('dash.empresa.configuracion', compact('empresa','users','cargos', 'sucursales'));
        }else{
            return back()->withInput();
        }
    	
    }

    //crear empresa en post register
    public function createEmpresaPostRegister(){
        $empresas = Auth::user()->empresas;
        if(count($empresas)>0){
            return redirect('/administracion');
        }else{
            return view('auth.post-register-empresa');
        }    
                
    }
}
