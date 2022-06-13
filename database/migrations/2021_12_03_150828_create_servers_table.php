<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id()->autoIncrement()->comment("ID сервера");
            $table->string("title")->comment("Название сервера");
            $table->longText("description")->comment("Описание");
            $table->boolean("is_launcher")->default(false)->comment("Лаунчер ли");
            $table->string("server_data")->comment("Данные сервера / лаунчера");
            $table->string("steam_app_id")->nullable(true)->comment("Steam app id");
            $table->bigInteger("online")->nullable(true)->comment("Онлайн на сервере");
            $table->string("banner_img")->nullable(true)->comment("Изображение баннера");
            $table->string("callback")->nullable(true)->comment("Ссылка для callback от сайта о том, что за сервер проголосовали");
            $table->string("site")->nullable(true)->comment("Сайт сервера");
            $table->string("vk")->nullable(true)->comment("ВК сайта");
            $table->string("discord")->nullable(true)->comment("Discord сервера");
            $table->unsignedBigInteger("game_id")->comment("Игра");
            $table->unsignedBigInteger("owner_id")->comment("Владелец сервера");
            $table->timestamps();

            $table->foreign("owner_id")->references("id")->on("users")->onDelete('cascade');
            $table->foreign("game_id")->references("id")->on("games");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers');
    }
}
