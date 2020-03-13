<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmpleadoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('doc_identidad', 15);
            $table->string('tipo_documento', 50);
            $table->string('direccion', 150); 
            $table->string('genero', 12); 
            $table->integer('id_pertenencia_sucursal_filtro');     
            $table->timestamps();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users'); 
            $table->integer('id_cargo_empleado')->unsigned();
            $table->foreign('id_cargo_empleado')->references('id')->on('cargos_empleado');  
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
