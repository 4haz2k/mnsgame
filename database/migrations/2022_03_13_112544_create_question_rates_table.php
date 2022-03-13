<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_rates', function (Blueprint $table) {
            $table->id()->comment("id вопроса");
            $table->bigInteger("helpful")->comment("Помог ответ на вопрос");
            $table->bigInteger("useless")->comment("Не помог ответ на вопрос");

            $table->foreign("id")->references("id")->on("questions");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_rates');
    }
}
