<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterBackGroundAndChartServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servers', function($table) {
            $table->string('background')->nullable(true)->after('banner_img')->comment("Задний фон сервера");
            $table->boolean('chart')->default(false)->after('callback')->comment("Есть ли график онлайна");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servers', function($table) {
            $table->dropColumn('background');
            $table->dropColumn('chart');
        });
    }
}
