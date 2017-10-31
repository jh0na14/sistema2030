<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('puntos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('numPunto')->nullable()->default(null);
            $table->string('nombre'); 
            $table->text('descripcion')->nullable()->default(null);
            $table->enum('nivel',array('1','2'));
           
            $table->integer('idagendas')->unsigned();
            $table->foreign('idagendas')->references('id')->on('agendas');
          
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
        Schema::dropIfExists('puntos');
    }
}
