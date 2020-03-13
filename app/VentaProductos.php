<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VentaProductos extends Model
{
    protected $table = "venta_productos";

    protected $fillable = [
        'id_producto',
        'id_venta',
        'precio',
        'cantidad_comprada',
        'submonto'
        
        
    ];
}
