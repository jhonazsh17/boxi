<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = "compras";

    protected $fillable = [
    	'nro_compra',
    	'tipo_documento',
    	'nro_documento',
    	'monto_compra',
    	'id_pertenencia_sucursal_filtro'
    ];
}
