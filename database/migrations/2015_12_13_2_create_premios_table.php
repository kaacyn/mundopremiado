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
            $table->integer('sort_id')->unsigned();
            $table->integer('prom_id')->unsigned();
            $table->integer('quantidade');
            $table->text('nome');
            $table->text('descricao');
            $table->decimal('valor',10,2);
        });

        Schema::table('premios', function($table) {
           $table->foreign('sort_id')->references('id')->on('sorteios')->onDelete('cascade');;
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
