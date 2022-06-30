<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_comercial');
            $table->string('razon_social');
            $table->string('email')->nullable();
            $table->unsignedBiginteger('pais_id')->index();
            $table->unsignedBiginteger('estado_id')->index();
            $table->unsignedBiginteger('municipio_id')->index();
            $table->string('calle');
            $table->string('numero_exterior');
            $table->string('numero_interior')->nullable();
            $table->string('colonia');
            $table->string('codigo_postal');
            $table->unsignedBiginteger('grupo_cliente_id')->index();
            $table->enum('estatus',['activo','suspendido','eliminado'])->default('activo');
            $table->foreign('pais_id')->references('id')->on('paises')->onDelete('no action');
            $table->foreign('estado_id')->references('id')->on('estados')->onDelete('no action');
            $table->foreign('municipio_id')->references('id')->on('municipios')->onDelete('no action');
            $table->foreign('grupo_cliente_id')->references('id')->on('clientes_grupos')->onDelete('no action');
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
        Schema::dropIfExists('clientes');
    }
}
