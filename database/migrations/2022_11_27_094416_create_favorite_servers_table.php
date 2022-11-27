<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoriteServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorite_servers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->comment("ID пользователя");
            $table->unsignedBigInteger("server_id")->comment("ID сервера");
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
        Schema::dropIfExists('favorite_servers');
    }
}
