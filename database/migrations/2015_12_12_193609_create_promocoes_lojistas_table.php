<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocoesLojistasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocoes_lojistas', function (Blueprint $table) {
            $table->integer('prom_id')->unsigned();
            $table->integer('loji_id')->unsigned();
        });

        Schema::table('promocoes_lojistas', function($table) {
           $table->foreign('prom_id')->references('id')->on('promocoes');
        });

        Schema::table('promocoes_lojistas', function($table) {
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
        Schema::drop('promocoes_lojistas');
    }
}
