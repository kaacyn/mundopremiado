<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromocoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promocoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('situacao');
            $table->string('slug')->unique();
            $table->string('data_inicio');
            $table->string('data_fim');
            $table->string('imagem');

            $table->string('url_hotsite');
            $table->string('url_regulamento');

            $table->decimal('valor_minimo');
            $table->decimal('valor_premiacao');

            $table->textarea('premiacao');

            $table->decimal('regiao');

            $table->text('descricao');

            $table->timestamps();
            $table->timestamp('published_at')->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('promocoes');
    }
}
