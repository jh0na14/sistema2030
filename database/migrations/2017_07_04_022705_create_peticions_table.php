<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeticionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peticions', function (Blueprint $table) {
            $table->increments('id');
            //$table->integer('numero');
            $table->string('titulo',30);
            $table->text('descripcion')->nullable()->default(null);
            $table->enum('estado',array('Disponible','Sin Finalizar','Finalizado'));
              
           // $table->integer('idbeneficiarios')->unsigned();
           // $table->foreign('idbeneficiarios')->references('id')->on('beneficiarios');
            
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
        Schema::dropIfExists('peticions');
    }
}
