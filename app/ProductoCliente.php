<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoCliente extends Model
{
    protected $table = "productos_clientes";

    protected $fillable = [
    	'precio',
    	'cantidad_vendida',
    	'submonto',
    	'id_producto',
    	'id_cliente',
    	'id_venta'
    ];
}
