<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
	protected $table = "categorias_producto";

    protected $fillable = [
        'nombre',
        'slug',
        'id_pertenencia_empresa_filtro'
    ];
}
