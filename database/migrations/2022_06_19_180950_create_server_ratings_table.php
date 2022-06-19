<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("server_id")->comment("ID сервера");
            $table->unsignedBigInteger("rating")->comment("Рейтинг сервера");

            $table->foreign("server_id")->references("id")->on("servers");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('server_ratings');
    }
}
