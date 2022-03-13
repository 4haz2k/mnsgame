<?php

namespace Database\Seeders;

use App\Models\QuestionRate;
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
    }
}
