<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MunicipiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipios', function (Blueprint $table){
           $table-> id()->index();
           $table -> unsignedBigInteger('estado_id')->index();
           $table->string('nombre');
           $table->timestamps();
           $table->softDeletes();
           $table->foreign('estado_id')->references('id')->on('estados')->onDelete('no action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('municipios');
    }
}
