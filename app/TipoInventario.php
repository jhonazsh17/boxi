<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoInventario extends Model
{
    protected $table = "tipos_inventario";

    protected $fillable = [
        'nombre',
        'slug',
        'id_pertenencia_empresa_filtro'
    ];

    /* => Función inventarios OneToMany */
    public function inventarios(){
        return $this->hasMany('App\Inventario', 'id_tipo_inventario', 'id');
    }
}
