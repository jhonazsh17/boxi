<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    protected $table = "inventarios";

    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'observacion',
        'id_pertenencia_almacen_filtro',
        'id_tipo_inventario',
    ];

    /* => Función tipo_inventario OneToMany(Inverse) */
    public function tipo_inventario(){
        return $this->belongsTo('App\TipoInventario', 'id_tipo_inventario');
    }
}
