<?php

namespace Database\Seeders;

use App\Models\Episode;
use Illuminate\Database\Seeder;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Episode::factory()->create([
            "name" => "Pilot",
            "season" => 1,
            "series" => 1,
            "premiere" => "2021-08-27",
            "description" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur eligendi pariatur ullam quis sint repudiandae quia aspernatur non ut possimus."
        ]);
        Episode::factory()->create([
            "name" => "Black dog",
            "season" => 1,
            "series" => 2,
            "premiere" => "2021-09-04",
            "description" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur eligendi pariatur ullam quis sint repudiandae quia aspernatur non ut possimus."
        ]);
        Episode::factory()->create([
            "name" => "Anatomy Park",
            "season" => 1,
            "series" => 3,
            "premiere" => "2021-09-11",
            "description" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur eligendi pariatur ullam quis sint repudiandae quia aspernatur non ut possimus."
        ]);
        Episode::factory()->create([
            "name" => "Mr Night Alien",
            "season" => 1,
            "series" => 4,
            "premiere" => "2021-09-18",
            "description" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur eligendi pariatur ullam quis sint repudiandae quia aspernatur non ut possimus."
        ]);
        Episode::factory()->create([
            "name" => "Divide and conquer",
            "season" => 1,
            "series" => 5,
            "premiere" => "2021-09-25",
            "description" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur eligendi pariatur ullam quis sint repudiandae quia aspernatur non ut possimus."
        ]);
    }
}
