<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nro_venta');
            $table->enum('tipo_documento', ['Boleta de Venta', 'Factura', 'Sin Documento'])->nullable();
            $table->integer('nro_documento')->nullable();
            $table->float('monto_venta', 8, 2);
            $table->enum('tipo_venta', ['Rápida', 'Contado', 'Credito', 'Consumo Propio']);
            $table->integer('dias_vencimiento_credito');
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
