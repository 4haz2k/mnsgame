<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialusers', function (Blueprint $table) {
            $table->id()->autoIncrement()->comment("ID пользователя");
            $table->json("data")->comment("Данные социальной сети");
            $table->timestamp("created_at")->nullable()->comment("Дата привязки");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('socialusers');
    }
}
