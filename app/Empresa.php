<?php

namespace App;

use App\User;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
	//Creamos variable que hace referencia a tabla empresas
    protected $table = "empresas";

    //Colocamos los campos de la tabla empresas
    protected $fillable = [
    	'ruc',
    	'razon_social',
    	'nombre_comercial',
    	'direccion',
    	'distrito',
    	'provincia',
    	'departamento',
    	'pais',
    	'descripcion',
    	'mision',
    	'vision',
    	'slug',
    	'logo',
    	'id_user'
    ];

    /* => Función user OneToMany(Inverse) */
    public function user()
    {
    	return $this->belongsTo(User::class, 'id_user', 'id');
    }

    /* => Función sucursales OneToMany */
    public function sucursales()
    {
    	return $this->hasMany('App\Sucursal', 'id_empresa', 'id');
    }
}
