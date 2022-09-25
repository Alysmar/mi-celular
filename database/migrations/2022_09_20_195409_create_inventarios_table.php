<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventarios', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad_producto'); //lo que da el proveedor
            $table->decimal('costo');
            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('proveedor_id')->constrained('proveedors');
            $table->date('fecha_inventario');//Año-Mes-Dia
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
        Schema::dropIfExists('inventarios');
    }
};
