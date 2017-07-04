<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProyectosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->increments('idproyectos');
            $table->date('fecha');
            $table->enum('tipo',array('Recaudacion','Donacion'));
            $table->enum('estado',array('Programado','Sin finalizar','Finalizado'));
            $table->double('presupuesto');
            $table->integer('idrecaudacions')->unsigned()->nullable()->default(null);
            $table->foreign('idrecaudacions')->references('idrecaudacions')->on('recaudacions');
            
            $table->integer('iddonacions')->unsigned()->nullable()->default(null);
            $table->foreign('iddonacions')->references('iddonacions')->on('donacions');
            
            $table->integer('idperiodos')->unsigned();
            $table->foreign('idperiodos')->references('idperiodos')->on('periodos');
            
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
        Schema::dropIfExists('proyectos');
    }
}
