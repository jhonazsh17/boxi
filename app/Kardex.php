<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kardex extends Model
{
    protected $table = "kardex_general";

    protected $fillable = [
    	'detalle',
        'id_operacion_filtro',
        'codigo_producto',
        'id_producto',
        'nombre_producto',
        'entidad',
        'saldo',
        'entrada',
        'salida',
        'cantidad',
        'stock',
        'created_at',
        'updated_at',
        'id_almacen'
    ];
}
