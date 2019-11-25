<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaVendas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendas', function(Blueprint $table){
            $table->increments('id_venda');
            $table->integer('id_vendedor')->unsigned();
            $table->foreign('id_vendedor')->references('id_usuario')->on('vendas');
            $table->integer('id_produto')->unsigned();
            $table->foreign('id_produto')->references('id_produto')->on('produtos');
            $table->integer('quantidade');
            $table->decimal('preco', 4, 2);
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
        Schema::dropIfExists('vendas');
        //
    }
}
