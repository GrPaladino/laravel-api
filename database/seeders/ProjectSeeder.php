<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {

        $types_id = Type::all()->pluck('id');

        for ($i = 0; $i < 100; $i++) {

            $project = new Project;
            $project->title = $faker->catchPhrase();
            $project->type_id = $faker->randomElement($types_id);
            $project->user_id = $faker->numberBetween(1, 2);
            $project->slug = Str::slug($project->title);
            $project->description = $faker->paragraph(3, true);
            $project->github_url = 'https://github.com/GrPaladino';
            $project->image = 'https://picsum.photos/200/300';
            $project->save();
        }

    }
}
