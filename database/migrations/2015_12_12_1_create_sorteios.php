<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSorteiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorteios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prom_id');
            $table->text('descricao');
            $table->integer('periodo_inicio');
            $table->integer('periodo_fim');
            $table->integer('data_sorteio');
        });

        Schema::table('sorteios', function($table) {
           $table->foreign('prom_id')->references('id')->on('promocoes');
        });
    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sorteios');
    }
}
