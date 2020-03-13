<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnidadMedida extends Model
{
    protected $table = "unidades_medida";

    protected $fillable = [
        'nombre',
        'abreviatura',
        'id_pertenencia_empresa_filtro'
    ];

    
}
