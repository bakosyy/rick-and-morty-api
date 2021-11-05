<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Character::factory()->create([
            "name" => "Albert Einstein",
            "status" => "dead",
            "gender" => "male",
            "race" => "human",
            "birth_location_id" => 1,
            "current_location_id" => 2
        ]);
        Character::factory()->create([
            "name" => "Rick Sanchez",
            "status" => "alive",
            "gender" => "male",
            "race" => "human",
            "description" => "The main protagonist of the animated series \"Rick and Morty \". A mad scientist whose alcoholism, recklessness, and sociopathy make his daughter's family worry",
            "birth_location_id" => 1,
            "current_location_id" => 2
        ]);
        Character::factory()->create([
            "name" => "Morti Smith",
            "status" => "alive",
            "gender" => "male",
            "race" => "human",
            "description" => "Mortimer \"Morty\" Smith Sr. is one of the two main characters of the series. I have to be Rick's grandson and often have to walk on his heels on his various \"misadventures\". Morty attends Harry Harrison High School with his sister Summer. In love with Jessica.",
            "birth_location_id" => 1,
            "current_location_id" => 2
        ]);
        Character::factory()->create([
            "name" => "Summer Smith",
            "status" => "alive",
            "gender" => "female",
            "race" => "human",
            "description" => "Summer Smith is the deuteragonist of Rick and Morty, as a member of the Smith Family. She is the daughter of Jerry Smith and Beth Smith, the older sister of Morty Smith, and the mother of Naruto Smith.",
            "birth_location_id" => 1,
            "current_location_id" => 1
        ]);
        Character::factory()->create([
            "name" => "Director of agency",
            "status" => "alive",
            "gender" => "male",
            "race" => "human",
            "birth_location_id" => 1,
            "current_location_id" => 1
        ]);
        Character::factory()->create([
            "name" => "Cat",
            "status" => "alive",
            "gender" => "male",
            "race" => "animal",
            "birth_location_id" => 1,
            "current_location_id" => 1
        ]);
    }
}
