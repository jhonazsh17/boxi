<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //Creamos variable que hace referencia a tabla empleado
    protected $table = "empleados";

    //Colocamos los campos de la tabla empleado
    protected $fillable = [
    	'doc_identidad',
        'tipo_documento',
    	'direccion',
    	'genero',
    	'id_pertenencia_sucursal_filtro',
    	'id_user',
    	'id_cargo_empleado'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cargo()
    {
        return $this->belongsTo('App\Cargo', 'id');
    }
}
