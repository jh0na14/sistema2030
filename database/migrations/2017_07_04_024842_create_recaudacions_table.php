<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecaudacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recaudacions', function (Blueprint $table) {
            $table->increments('idrecaudacions');
            $table->text('descripcion');            
            $table->double('ingresos',15,2);
            $table->double('gastos',15,2);
            $table->date('fecha');
            $table->double('totalRecaudado',15,2);
            $table->text('socios'); //socios que participaron           
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
        Schema::dropIfExists('recaudacions');
    }
}
