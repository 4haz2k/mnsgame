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
            $table->string("description")->comment("Описание");
            $table->boolean("is_launcher")->default(false)->comment("Лаунчер ли");
            $table->string("server_data")->comment("Данные сервера / лаунчера");
            $table->string("banner_img")->default("/storage/default_banner.png")->comment("Изображение баннера");
            $table->string("logo_img")->default("/storage/default_logo.png")->comment("Логотип");
            $table->string("callback")->default("")->comment("Ссылка для callback от сайта о том, что за сервер проголосовали");
            $table->unsignedBigInteger("game_id")->comment("Игра");
            $table->unsignedBigInteger("owner_id")->comment("Владелец сервера");
            $table->timestamps();

            $table->foreign("owner_id")->references("id")->on("users");
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
