<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmembresiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmembresias', function (Blueprint $table) {
            $table->increments('idtmembresias');
            $table->date('fecha');
            $table->text('concepto');
            $table->double('ingreso',15,2);
            $table->double('egreso',15,2);
            $table->double('saldo',15,2);
            
            $table->integer('idsocios')->unsigned();
            $table->foreign('idsocios')->references('id')->on('socios');
            
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
        Schema::dropIfExists('tmembresias');
    }
}
