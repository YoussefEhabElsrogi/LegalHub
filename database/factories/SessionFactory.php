<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'case_type' => $this->faker->word(),
            'case_number' => $this->faker->randomNumber(5),
            'opponent_name' => $this->faker->name(),
            'session_date' => $this->faker->date(),
            'case_status' => $this->faker->randomElement(['سارية', 'محفوظة']),
            'notes' => $this->faker->sentence(),
        ];
    }
}