<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id()->unique()->autoIncrement()->comment("ID игры");
            $table->string("title")->comment("Название игры");
            $table->string("developer")->comment("Разработчик");
            $table->string("description")->nullable()->comment("Описание игры");
            $table->string("image_short")->comment("Изображение на странице игр");
            $table->string("image")->comment("Изображение на странице серверов игры");
            $table->string("short_link")->comment("Короткая ссылка");
            $table->string("platform")->comment("Короткая ссылка");
            $table->string("steam_app_id")->nullable(true)->comment("Steam app id");
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
        Schema::dropIfExists('games');
    }
}
