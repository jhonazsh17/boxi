<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = "productos";

    protected $fillable = [
        'codigo',
        'nombre',
        'nombre_comercial',
        'cantidad_presentacion',
        'precio',
        'slug',
        'id_unidad_medida',
        'id_categoria_producto'
    ];
}
