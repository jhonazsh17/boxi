<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKardexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardex_general', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('detalle', ['Venta', 'Compra', 'Inventario Inicial','Traspaso']);
            $table->integer('id_operacion_filtro');
            $table->string('codigo_producto', 20);
            $table->integer('id_producto');
            $table->string('nombre_producto', 100)->nullable();
            $table->string('entidad');
            $table->integer('saldo');
            $table->enum('entrada', ['True', 'False']);
            $table->enum('salida', ['True', 'False']);
            $table->integer('cantidad');
            $table->integer('stock');
            $table->timestamps();
            $table->integer('id_almacen')->unsigned();
            $table->foreign('id_almacen')->references('id')->on('almacenes');
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
