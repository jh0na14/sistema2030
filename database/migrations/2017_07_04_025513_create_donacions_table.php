<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donacions', function (Blueprint $table) {
            $table->increments('id');
            $table->double('monto',15,2);
            $table->text('descripcion');            
            $table->date('fecha');
            $table->enum('tipo',array('Realizada','Recibida'));//si es realizada puede ser spot o total sino solo total
            $table->enum('categoria',array('Spot','Total'));
            $table->integer('idpeticions')->unsigned()->nullable()->default(null);
            $table->foreign('idpeticions')->references('id')->on('peticions');
            $table->integer('idpatrocinadors')->unsigned()->nullable()->default(null);
            $table->foreign('idpatrocinadors')->references('id')->on('patrocinadors');
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
        Schema::dropIfExists('donacions');
    }
}
