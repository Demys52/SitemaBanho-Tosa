<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItensServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itens_servicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('servico_id')->unsigned();
            $table->integer('pet_id')->unsigned();
            $table->integer('item_servico')->unsigned();
            $table->integer('quantidade');
            $table->float('valor_unidade');
            $table->float('valor_desconto')->default(0);
            $table->float('valor_total');
            $table->timestamps();
        });
        
        Schema::table('itens_servicos', function (Blueprint $table) {
            $table->foreign('servico_id')->references('id')->on('servicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itens_servico');
    }
}
