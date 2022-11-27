<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerRconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_rcons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("server_id")->comment("ID сервера");
            $table->string("address")->nullable()->comment("IP адрес сервера");
            $table->longText("rcon_port")->comment("Rcon порт");
            $table->longText("rcon_password")->comment("Зашифрованный RCON пароль");
            $table->boolean("is_connected")->comment("Подключен ли сервер к RCON");
            $table->dateTime("activated_time")->comment("Время активации соединения");
            $table->timestamps();

            $table->foreign("server_id")->references("id")->on("servers")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('server_rcons');
    }
}
