<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo', 20);
            $table->string('nombre', 100);
            $table->string('nombre_comercial', 100)->nullable();
            $table->decimal('cantidad_presentacion', 8, 2);
            $table->decimal('precio', 8, 2);
            $table->string('slug', 100);
            $table->enum('visible', array(1,0));
            $table->timestamps();
            $table->integer('id_unidad_medida')->unsigned();
            $table->foreign('id_unidad_medida')->references('id')->on('unidades_medida');
            $table->integer('id_categoria_producto')->unsigned();
            $table->foreign('id_categoria_producto')->references('id')->on('categorias_producto');   
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
