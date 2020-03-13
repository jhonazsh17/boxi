<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = "proveedores";

    protected $fillable = [
    	'dni',
    	'ruc',
    	'nombre',
    	'direccion',
    	'lugar',
    	'lugar_proveniencia',
    	'slug',
    	'id_pertenencia_empresa_filtro'
    ];
}
