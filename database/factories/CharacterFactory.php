<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Character::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'status' => $this->faker->randomElement(['alive', 'dead']),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'race' => $this->faker->randomElement(['human', 'alien', 'robot', 'humanoid', 'animal']),
            'description' => $this->faker->words(35, true)
        ];
    }
}
