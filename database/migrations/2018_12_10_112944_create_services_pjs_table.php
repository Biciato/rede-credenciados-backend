<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesPjsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividade_pessoa_juridicas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pessoa_juridica_id');
            $table->foreign('pessoa_juridica_id')->references('id')->on('pessoa_juridicas');
            $table->text('atividades');
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
        Schema::dropIfExists('atividade_pessoa_juridicas');
    }
}
