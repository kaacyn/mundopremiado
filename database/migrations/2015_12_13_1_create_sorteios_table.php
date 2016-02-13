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
            $table->integer('prom_id')->unsigned();
            $table->text('observacao');
            $table->integer('periodo_inicio')->nullable();
            $table->integer('periodo_fim')->nullable();
            $table->integer('data_sorteio')->nullable();
        });




        Schema::table('sorteios', function($table) {
           $table->foreign('prom_id')->references('id')->on('promocoes')->onDelete('cascade');;
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
