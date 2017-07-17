<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerdugosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verdugos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fechaPago');
            $table->double('montoRecaudado');
            $table->double('montoRifa')->nullable()->default(null);
            $table->integer('idsocios')->unsigned();
            $table->foreign('idsocios')->references('id')->on('socios');
             
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
        Schema::dropIfExists('verdugos');
    }
}
