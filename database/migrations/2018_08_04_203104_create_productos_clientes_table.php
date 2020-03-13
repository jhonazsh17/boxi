<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_clientes', function (Blueprint $table) {
            $table->increments('id');  
            $table->float('precio', 8, 2);  
            $table->integer('cantidad_vendida'); 
            $table->float('submonto', 8, 2); 
            $table->timestamps();      
            $table->integer('id_producto')->unsigned();
            $table->foreign('id_producto')->references('id')->on('productos');
            $table->integer('id_cliente')->unsigned();
            $table->foreign('id_cliente')->references('id')->on('clientes'); 
            $table->integer('id_venta')->unsigned();
            $table->foreign('id_venta')->references('id')->on('ventas'); 
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
