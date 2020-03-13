<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProveedorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dni');
            $table->double('ruc');
            $table->string('nombre', 100);
            $table->string('direccion', 100);
            $table->string('lugar', 45);
            $table->string('lugar_proveniencia', 45);
            $table->string('slug', 100);
            $table->integer('id_pertenencia_empresa_filtro');
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
