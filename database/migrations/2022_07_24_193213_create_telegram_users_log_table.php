<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramUsersLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_users_log', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->comment("ID пользователя");
            $table->bigInteger("chat_id")->comment("ID чата");
            $table->longText("message")->nullable(true)->comment("Сообщение");
            $table->dateTime("date")->comment("Время обращения");

            $table->foreign("user_id")->references("id")->on("telegram_users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_users_log');
    }
}
