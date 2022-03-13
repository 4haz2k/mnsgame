<?php

namespace Database\Factories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionRateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            "id" => Question::factory()->create()->id,
            "helpful" => $this->faker->numberBetween(0, 200),
            "useless" => $this->faker->numberBetween(0, 200)
        ];
    }
}
