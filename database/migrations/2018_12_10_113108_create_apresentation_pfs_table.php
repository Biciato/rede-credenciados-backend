<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApresentationPfsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apresentacao_pessoa_fisicas', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pessoa_fisica_id');
            $table->foreign('pessoa_fisica_id')->references('id')->on('pessoa_fisicas');
            $table->text('apresentacao')->nullable();
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
        Schema::dropIfExists('apresentacao_pessoa_fisicas');
    }
}
