<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterOfServerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_of_server', function (Blueprint $table) {
            $table->unsignedBigInteger("game_id")->comment("ID игры");
            $table->unsignedBigInteger("filter_id")->comment("ID фильтра");

            $table->foreign("game_id")->references('id')->on("games");
            $table->foreign("filter_id")->references('id')->on("filters");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_filter_of_server');
    }
}
