<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropagandaUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propaganda_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('users_propaganda_id');
            $table->foreign('users_propaganda_id')->references('id')->on('users_propagandas');
            $table->text('estados_lateral')->nullable();
            $table->text('estados_topo')->nullable();
            $table->text('cidades_lateral')->nullable();
            $table->text('cidades_topo')->nullable();
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
        Schema::dropIfExists('propaganda_users');
    }
}
