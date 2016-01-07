<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periodos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('data_inicio');
            $table->string('data_fim');
            $table->integer('prom_id')->unsigned();
            $table->timestamps();
        });


        Schema::table('periodos', function($table) {
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
   
        Schema::drop('periodos');
    }
}
