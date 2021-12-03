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
            $table->string("callback")->default(null)->comment("Ссылка для callback от сайта о том, что за сервер проголосовали");
            $table->json("filters")->default(null)->comment("Фильтры, к которым относится сервер");
            $table->string("game")->comment("Игра");
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
        Schema::dropIfExists('servers');
    }
}
