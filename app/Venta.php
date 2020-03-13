<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = "ventas";

    protected $fillable = [
    	'nro_venta',
    	'tipo_documento',
    	'nro_documento',
    	'monto_venta',
    	'tipo_venta',
    	'dias_vencimiento_credito',
    	'id_pertenencia_sucursal_filtro'
    ];

}
