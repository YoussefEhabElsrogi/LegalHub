<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Procuration>
 */
class ProcurationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'authorization_number' => $this->faker->randomNumber(5),
            'notebook_number' => $this->faker->randomNumber(5),
            'notes' => $this->faker->sentence(),
        ];
    }
}
