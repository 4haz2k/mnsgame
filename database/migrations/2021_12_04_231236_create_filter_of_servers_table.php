<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilterOfServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filter_of_servers', function (Blueprint $table) {
            $table->unsignedBigInteger("filter_id")->comment("ID фильтра");
            $table->unsignedBigInteger("server_id")->comment("ID сервера");

            $table->foreign("filter_id")->references("id")->on("filters");
            $table->foreign("server_id")->references("id")->on("servers");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filter_of_servers');
    }
}
