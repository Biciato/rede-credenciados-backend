<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesPfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividade_pessoa_fisicas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pessoa_fisica_id');
            $table->foreign('pessoa_fisica_id')->references('id')->on('pessoa_fisicas');
            $table->string('atividades');
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
        Schema::dropIfExists('atividade_pessoa_fisicas');
    }
}
