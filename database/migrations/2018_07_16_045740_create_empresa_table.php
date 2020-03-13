<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpresaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->increments('id');
            $table->double('ruc');
            $table->string('razon_social', 100);
            $table->string('nombre_comercial', 100)->nullable();
            $table->string('direccion', 100);
            $table->string('distrito', 45);
            $table->string('provincia', 45);
            $table->string('departamento', 45);
            $table->string('pais', 45);
            $table->text('descripcion', 280)->nullable();
            $table->text('mision', 280)->nullable();
            $table->text('vision', 280)->nullable();
            $table->string('slug', 100);  
            $table->string('logo', 100)->nullable();
            $table->timestamps();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');    
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
