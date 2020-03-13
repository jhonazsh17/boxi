<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nro_compra');
            $table->enum('tipo_documento', ['Boleta de Venta', 'Factura']);
            $table->integer('nro_documento');
            $table->float('monto_compra', 8, 2);
            $table->integer('id_pertenencia_sucursal_filtro');
            $table->timestamps();            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
