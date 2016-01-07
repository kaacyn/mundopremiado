<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutosLojistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos_lojistas', function (Blueprint $table) {
            $table->integer('prod_id')->unsigned();
            $table->integer('loji_id')->unsigned();
        });

        Schema::table('produtos_lojistas', function($table) {
           $table->foreign('prod_id')->references('id')->on('produtos');
        });

        Schema::table('produtos_lojistas', function($table) {
           $table->foreign('loji_id')->references('id')->on('lojistas');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('produtos_lojistas');
    }
}
