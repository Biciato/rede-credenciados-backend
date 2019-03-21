<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnidadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unidades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('pessoa_juridica_id');
            $table->foreign('pessoa_juridica_id')->references('id')->on('pessoa_juridicas');
            $table->string('cnpj')->unique();
            $table->string('razao_social');
            $table->string('nome_fantasia');
            $table->string('nome_contato');
            $table->string('email');
            $table->string('email2')->nullable();
            $table->string('tel');
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
        Schema::dropIfExists('unidades');
    }
}
