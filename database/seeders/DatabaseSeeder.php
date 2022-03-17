<?php

namespace Database\Seeders;

use App\Models\QuestionOfCategoryModel;
use App\Models\QuestionRate;
use App\Models\TopicCategoryModel;
use Database\Factories\QuestionCategoryFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        QuestionRate::factory(250)->create();

        TopicCategoryModel::factory(12)->create();
        QuestionOfCategoryModel::factory(48)->create();
    }
}
