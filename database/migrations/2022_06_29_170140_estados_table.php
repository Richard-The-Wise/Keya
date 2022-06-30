<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados', function (Blueprint $table ){
            $table->id()->index();
            $table->unsignedBigInteger('pais_id')->index();
            $table->string('nombre');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('pais_id')->references('id')->on('paises')->onDelete('no action');

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados');
    }
}
