<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropagandaPessoaJuridicaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propaganda_pessoa_juridica', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pessoa_juridica_id');
            $table->foreign('pessoa_juridica_id')->references('id')->on('pessoa_juridicas');
            $table->string('estados_lateral')->nullable();
            $table->string('estados_topo')->nullable();
            $table->string('cidades_lateral')->nullable();
            $table->string('cidades_topo')->nullable();
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
        Schema::dropIfExists('propaganda_pessoa_juridica');
    }
}
