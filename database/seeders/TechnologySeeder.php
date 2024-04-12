<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $technology_names = ['HTML', 'CSS', 'BOOTSRTAP', 'SASS', 'JAVASCRIPT', 'VUEJS', 'NODEJS', 'LARAVEL', 'PHP', 'BLADE'];

        foreach ($technology_names as $technology_name) {
            $technology = new Technology;
            $technology->label = $technology_name;
            $technology->color = $faker->hexColor();
            $technology->save();
        }
    }
}
