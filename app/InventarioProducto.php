<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventarioProducto extends Model
{
    protected $table = "inventarios_productos";

    protected $fillable = [
        'stock_historial',
    	'id_producto',
    	'id_inventario'
    ]; 
}
