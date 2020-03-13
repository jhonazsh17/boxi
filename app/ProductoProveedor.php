<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoProveedor extends Model
{
    protected $table = "productos_proveedores";

    protected $fillable = [
    	'precio',
    	'cantidad_comprada',
    	'submonto',
    	'id_producto',
    	'id_proveedor',
    	'id_compra'
    ];
}
