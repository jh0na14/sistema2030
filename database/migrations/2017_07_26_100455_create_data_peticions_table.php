<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataPeticionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peticions', function (Blueprint $table) {
          $table->integer('idbeneficiarios')->unsigned();
          $table->foreign('idbeneficiarios')->references('id')->on('beneficiarios');
          $table->integer('idsolicitantes')->unsigned();
          $table->foreign('idsolicitantes')->references('id')->on('solicitantes');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peticions', function (Blueprint $table) {
           $table->dropColumn('idbeneficiarios');
           $table->dropColumn('idsolicitantes');
       
        });
    }
}
