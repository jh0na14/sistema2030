<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSociomembresiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sociomembresias', function (Blueprint $table) {
            $table->increments('idsociomembresias');
            $table->integer('idmembresias')->unsigned();
            $table->foreign('idmembresias')->references('idmembresias')->on('membresias');
            $table->integer('idsocios')->unsigned();
            $table->foreign('idsocios')->references('idsocios')->on('socios');
            $table->date('fechaPago');
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
        Schema::dropIfExists('sociomembresias');
    }
}
