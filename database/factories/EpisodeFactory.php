<?php

namespace Database\Factories;

use App\Models\Episode;
use Illuminate\Database\Eloquent\Factories\Factory;

class EpisodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Episode::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => $this->faker->word(),
            "season" => 1,
            "series" => $this->faker->numberBetween(6,35),
            "premiere" => "2022-01-01",
            "description" => "Lorem ipsum dolor, sit amet consectetur adipisicing elit. Consequuntur eligendi pariatur ullam quis sint repudiandae quia aspernatur non ut possimus."
        ];
    }
}
