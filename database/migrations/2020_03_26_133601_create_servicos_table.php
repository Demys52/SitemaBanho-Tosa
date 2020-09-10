<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();
            $table->integer('cliente_id')->unsigned();
            $table->float('valor');
            $table->string('status');
            $table->integer('finalizado')->nullable();
            $table->integer('alterado')->nullable();
            $table->integer('cancelado')->nullable();
            $table->string('observacao')->nullable();
            $table->timestamps();
            $table->dateTime('data_hora_finalizado', 0)->nullable();;
            $table->dateTime('data_hora_alterado', 0)->nullable();;
            $table->dateTime('data_hora_cancelado', 0)->nullable();;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servicos');
    }
}
