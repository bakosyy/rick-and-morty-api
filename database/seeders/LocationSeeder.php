<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::factory()->create([
            "name" => "Earth",
            "type" => "planet",
            "dimension" => "c-137",
            "description" => "Earth planet is where we living in"
        ]);
        Location::factory()->create([
            "name" => "Saturn",
            "type" => "planet",
            "dimension" => "substituted",
            "description" => "Saturn is away from the Earth. Saturn is away from the Earth. Saturn is away from the Earth."
        ]);
        Location::factory()->create([
            "name" => "Space",
            "type" => "base",
            "dimension" => "substituted",
            "description" => "Space is in the sky Space is in the sky Space is in the sky Space is in the sky"
        ]);
    }
}
