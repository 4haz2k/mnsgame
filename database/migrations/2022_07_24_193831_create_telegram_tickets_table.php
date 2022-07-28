<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_tickets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id")->comment("ID пользователя");
            $table->unsignedBigInteger("chat_id")->comment("ID чата");
            $table->enum("step", [
                "theme",
                "body",
                "waiting",
                "resolving",
                "closed"
            ])->comment("Шаг текущего обращения");
            $table->unsignedBigInteger("support_id")->nullable(true)->comment("ID специалиста");
            $table->longText("theme")->nullable(true)->comment("Тема обращения");
            $table->longText("body")->nullable(true)->comment("Обращение");
            $table->boolean("is_creating")->default(false)->comment("Создается ли обращение на данный момент");
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("telegram_users");
            $table->foreign("support_id")->references("id")->on("telegram_supporters");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_tickets');
    }
}
