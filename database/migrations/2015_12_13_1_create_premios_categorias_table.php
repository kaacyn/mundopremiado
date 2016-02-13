<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePremiosCategoriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premios_categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prom_id')->unsigned();
            $table->text('nome');
        });

        Schema::table('premios_categorias', function($table) {
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
        Schema::drop('premios_categorias');
    }
}
