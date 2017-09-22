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
            $table->increments('id');
            $table->integer('idmembresias')->unsigned();
            $table->foreign('idmembresias')->references('id')->on('membresias');
            $table->integer('idsocios')->unsigned();
            $table->foreign('idsocios')->references('id')->on('socios');
            $table->date('fechaPago');
            $table->enum('estado',array('CANCELADO','PENDIENTE'));
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
