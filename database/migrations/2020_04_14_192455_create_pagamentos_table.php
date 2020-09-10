<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagamentos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('id_servico')->unsigned();
            $table->integer('id_formadepagamento')->unsigned();
            $table->integer('parcela')->nullable();
            $table->float('valor');
            $table->timestamps();
        });
        Schema::table('pagamentos', function (Blueprint $table) {
            $table->foreign('id_servico')->references('id')->on('servicos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagamentos');
    }
}
