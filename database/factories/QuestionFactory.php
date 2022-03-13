<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->text(50),
            "answer" => $this->faker->realText,
            "dateTime" => $this->faker->dateTime
        ];
    }
}
