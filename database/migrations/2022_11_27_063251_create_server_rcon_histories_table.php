<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerRconHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_rcon_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("server_id")->comment("ID сервера");
            $table->mediumText("log")->comment("Лог команд");
            $table->boolean("deleted")->comment("Удалено ли");
            $table->boolean("by_user")->default(false)->comment("Отправлена ли команда пользователем");
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
        Schema::dropIfExists('server_rcon_histories');
    }
}
