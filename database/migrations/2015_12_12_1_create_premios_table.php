<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePremiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premios', function (Blueprint $table) {
            $table->integer('prom_id');
            $table->integer('quantidade');
            $table->string('nome');
            $table->decimal('valor');
        });

        Schema::table('premios', function($table) {
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
        Schema::drop('premios');
    }
}