<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryOfQuestionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_of_question', function (Blueprint $table) {
            $table->unsignedBigInteger("category_id")->comment("id категории");
            $table->unsignedBigInteger("question_id")->comment("id вопроса");

            $table->foreign("category_id")->references("id")->on("topic_category");
            $table->foreign("question_id")->references("id")->on("questions");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_of_question');
    }
}
