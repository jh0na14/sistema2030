<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubpuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subpuntos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre'); 
            $table->text('descripcion')->nullable()->default(null);
            $table->enum('nivel',array('1','2'));
           
            $table->integer('idpuntos')->unsigned();
            $table->foreign('idpuntos')->references('id')->on('puntos');
          
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
        Schema::dropIfExists('subpuntos');
    }
}
