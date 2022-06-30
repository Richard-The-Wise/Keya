<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteDireccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente_direcciones', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('calle');
            $table->string('numero_exterior');
            $table->string('numero_interior')->nullable();
            $table->string('colonia');
            $table->string('codigo_postal');
            $table->unsignedBiginteger('cliente_id')->index();
            $table->unsignedBiginteger('pais_id')->index();
            $table->unsignedBiginteger('estado_id')->index();
            $table->unsignedBiginteger('municipio_id')->index();
            $table->foreign('pais_id')->references('id')->on('paises')->onDelete('no action');
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('no action');
            $table->foreign('municipio_id')->references('id')->on('municipios')->onDelete('no action');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('no action');
            $table->enum('estatus',['activo','suspendido','eliminado'])->default('activo');
            $table->enum('tipo',['envio','facturacion']);
            $table->softDeletes()->nullable();
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
        Schema::dropIfExists('cliente_direcciones');
    }
}
