<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement()->comment("ID пользователя");
            $table->string("name")->comment("Имя");
            $table->string("surname")->comment("Фамилия");
            $table->string("login")->comment("Логин пользователя");
            $table->string("password")->comment("Пароль пользователя");
            $table->string("email")->comment("E-mail пользователя");
            $table->dateTime("registration_date")->comment("Дата регистрации");
            $table->dateTime("login_date")->comment("Дата регистрации");
            $table->double("balance")->comment("Баланс");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
