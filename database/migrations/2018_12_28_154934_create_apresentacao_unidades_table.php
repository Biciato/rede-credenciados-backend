<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApresentacaoUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apresentacao_unidades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('unidade_id');
            $table->foreign('unidade_id')->references('id')->on('unidades');
            $table->text('apresentacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apresentacao_unidades');
    }
}
