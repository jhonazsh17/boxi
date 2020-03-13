<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCategoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_producto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45);
            $table->string('slug', 45);
            $table->integer('id_pertenencia_empresa_filtro');
            $table->enum('visible', array(1,0));
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
