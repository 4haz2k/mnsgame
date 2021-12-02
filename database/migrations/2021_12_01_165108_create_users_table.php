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
            $table->string("login")->unique()->comment("Логин пользователя");
            $table->string("password")->comment("Пароль пользователя");
            $table->string("email")->unique()->comment("E-mail пользователя");
            $table->timestamp('email_verified_at')->nullable()->comment("Дата подтверждения E-mail");
            $table->timestamp("registration_date")->comment("Дата регистрации");
            $table->timestamp("login_date")->nullable()->comment("Дата входа");
            $table->double("balance")->default(0)->comment("Баланс");
            $table->rememberToken()->nullable()->comment("rememberToken");
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
        Schema::dropIfExists('users');
    }
}
