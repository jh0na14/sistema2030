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
            $table->increments('id');
            $table->string('nombre',30);
            $table->date('fechaInicio');
            $table->date('fechaFin');
            $table->enum('tipo',array('Recaudacion','Donacion'));
            $table->enum('estado',array('Programado','Cancelado','Finalizado'));
            $table->double('presupuesto');
            $table->integer('idrecaudacions')->unsigned()->nullable()->default(null);
            $table->foreign('idrecaudacions')->references('id')->on('recaudacions');
            
            $table->integer('idpeticions')->unsigned()->nullable()->default(null);
            $table->foreign('idpeticions')->references('id')->on('peticions');
            
            $table->integer('idperiodos')->unsigned();
            $table->foreign('idperiodos')->references('id')->on('periodos');
            
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
