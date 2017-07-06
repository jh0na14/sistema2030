<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socios', function (Blueprint $table) {
            $table->increments('idsocios');    
            $table->string('nombre',30);
            $table->string('apellido', 30);
            $table->date('fechaNac');
            $table->string('dui', 10);
            $table->text('direccion');
            $table->string('telefono',9);
            $table->string('email');
            $table->string('apodo',35);
            $table->enum('tipoSocio',array('Socio Activo','Activo Mayor'));
            $table->enum('cargo',array('Presidente','Secretario','Tesorero','Sin Cargo'));
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
        Schema::dropIfExists('socios');
    }
}
