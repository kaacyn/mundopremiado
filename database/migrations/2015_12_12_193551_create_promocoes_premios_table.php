<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocoesPremiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocoes_premios', function (Blueprint $table) {
            $table->integer('prom_id')->unsigned();
            $table->integer('prem_id')->unsigned();
        });

        Schema::table('promocoes_premios', function($table) {
           $table->foreign('prom_id')->references('id')->on('promocoes');
        });

        Schema::table('promocoes_premios', function($table) {
           $table->foreign('prem_id')->references('id')->on('promocoes');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('promocoes_premios');
    }
}
