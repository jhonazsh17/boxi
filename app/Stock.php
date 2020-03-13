<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = "stock";

    protected $fillable = [
    	'id_producto',
    	'cantidad_en_stock',
    	'anterior_cantidad_en_stock'
    ];
}
