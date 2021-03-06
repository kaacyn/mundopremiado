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
            $table->string('data_inicio')->nullable();
            $table->string('data_fim')->nullable();
            $table->string('imagem');

            $table->string('url_hotsite');
            $table->string('url_regulamento');
            $table->string('url_ganhadores');

            $table->decimal('valor_minimo',10,2);
            //$table->decimal('valor_premiacao',10,2);

            $table->text('premiacao');

            $table->string('regiao');

            $table->longText('descricao');

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
