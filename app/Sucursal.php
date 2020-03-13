<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = "sucursales";

    protected $fillable = [
        'nombre_sucursal',
        'lugar',
        'direccion',
        'descripcion',
        'serie',
        'slug',
        'id_empresa',
    ];

    /* => Función empresa OneToMany(Inverse) */
    public function empresa()
    {
    	return $this->belongsTo('App\Empresa','id');
    }
}