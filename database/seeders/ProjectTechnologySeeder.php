<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectTechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $projects = Project::all();

        $technologies = Technology::all()->pluck('id')->toArray();
        $technologies_length = count($technologies);


        foreach ($projects as $project) {
            $fake_num_tech = $faker->numberBetween(0, $technologies_length);
            $project->technologies()->sync($faker->randomElements($technologies, $fake_num_tech));
        }
    }
}
