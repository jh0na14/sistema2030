<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagoasociasionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagoasociasions', function (Blueprint $table) {
            $table->increments('id');
            $table->double('monto',15,2);
            $table->date('fecha');
           
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
        Schema::dropIfExists('pagoasociasions');
    }
}
