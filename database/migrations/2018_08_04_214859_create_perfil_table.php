<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfilTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perfiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45);
            $table->integer('edad');
            $table->enum('genero', ['Masculino', 'Femenino', 'Sin Especificar'])->nullable();
            $table->string('direccion', 100)->nullable();  
            $table->date('fecha_nacimiento')->nullable();
            $table->string('foto_perfil', 45)->nullable();            
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
