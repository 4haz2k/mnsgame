<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTelegramSupportersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('telegram_supporters', function (Blueprint $table) {
            $table->id()->comment("ID пользователя");
            $table->bigInteger("chat_id")->comment("ID чата администратора");
            $table->string("description")->comment("Описание");

            $table->foreign("id")->references("id")->on("telegram_users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('telegram_supporters');
    }
}
