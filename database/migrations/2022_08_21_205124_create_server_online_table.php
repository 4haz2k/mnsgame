<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerOnlineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers_online', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("server_id")->nullable();
            $table->integer("online");
            $table->timestamps();

            $table->foreign("server_id")->references("id")->on("servers")->onDelete("set null");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servers_online');
    }
}
