<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AlmacenProducto extends Model
{
    protected $table = "almacenes_productos";

    protected $fillable = [
    	'id_almacen',
        'id_producto'
    ];
}
