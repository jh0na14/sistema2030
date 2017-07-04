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
            $table->increments('idpeticions');
            $table->date('fecha');
            $table->string('nombre',30);
            $table->string('apellido', 30)->nullable()->default(null);
            $table->string('dui', 10);
            $table->integer('idbeneficiarios')->unsigned();
            $table->foreign('idbeneficiarios')->references('idbeneficiarios')->on('beneficiarios');
            
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
