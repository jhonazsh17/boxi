<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
    protected $table = "almacenes";

    protected $fillable = [
    	'id_sucursal',
        'nombre',
        'lugar',
        'direccion',        
        'descripcion',
        'slug'
    ];
}
