<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pessoa_fisicas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('nome');
            $table->string('cpf')->unique();
            $table->string('rg')->nullable()->unique();
            $table->string('nascimento')->nullable();
            $table->string('sexo');
            $table->string('email')->unique();
            $table->string('email2')->nullable();
            $table->string('tel')->nullable();
            $table->string('tel2')->nullable();
            $table->string('cel')->nullable();
            $table->string('cel2')->nullable();
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
        Schema::dropIfExists('pessoa_fisicas');
    }
}
