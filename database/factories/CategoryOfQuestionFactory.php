<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\QuestionOfCategoryModel;
use App\Models\TopicCategoryModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryOfQuestionFactory extends Factory
{
    protected $model = QuestionOfCategoryModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            "category_id" => TopicCategoryModel::all()->random()->id,
            "question_id" => Question::all()->random()->id
        ];
    }
}
