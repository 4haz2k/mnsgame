<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_views', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("server_id")->comment("ID сервера");
            $table->text("visitor_uuid")->comment("UUID пользователя");
            $table->timestamps();

            $table->foreign("server_id")->references("id")->on("servers")->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('server_views');
    }
}
