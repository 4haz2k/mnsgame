<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_rates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("voter_id")->comment("ID проголосовавшего");
            $table->unsignedBigInteger("server_id")->comment("ID сервера");
            $table->dateTime("vote_time")->comment("Время голосования");

            $table->foreign("voter_id")->references("id")->on("users")->onDelete('cascade');
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
        Schema::dropIfExists('server_rates');
    }
}
