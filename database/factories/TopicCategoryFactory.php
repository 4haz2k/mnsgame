<?php

namespace Database\Factories;

use App\Models\TopicCategoryModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicCategoryFactory extends Factory
{
    protected $model = TopicCategoryModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            "title" => $this->faker->text(10),
        ];
    }
}
