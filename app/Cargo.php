<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = "cargos_empleado";

    protected $fillable = [
        'nombre',
        'id_pertenencia_empresa_filtro'
    ];

    public function empleados()
    {
    	return $this->hasMany('App\Empleado', 'id_cargo', 'id');
    }
}
