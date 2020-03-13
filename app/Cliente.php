<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";

    protected $fillable = [
        'dni',
        'ruc',
        'nombre',
        'slug',
        'id_pertenencia_empresa_filtro',
        
        
    ];
}
