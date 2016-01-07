<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocoesProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocoes_produtos', function (Blueprint $table) {
            $table->integer('prom_id')->unsigned();
            $table->integer('prod_id')->unsigned();
        });

        Schema::table('promocoes_produtos', function($table) {
           $table->foreign('prom_id')->references('id')->on('promocoes');
        });

        Schema::table('promocoes_produtos', function($table) {
           $table->foreign('prod_id')->references('id')->on('produtos');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('promocoes_produtos');
    }
}
