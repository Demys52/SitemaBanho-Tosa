<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->string('nome');
            $table->string('raca');
            $table->string('porte');
            $table->decimal('preco', 10,6)->nullable();
            $table->timestamps();
        });
        //Schema::table('pets', function (Blueprint $table) {
           //$table->foreign('cliente_id')->references('id')->on('clientes'); 
        //});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pets');
    }
}
