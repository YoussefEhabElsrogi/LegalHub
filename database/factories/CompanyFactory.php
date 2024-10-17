<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'company_name' => $this->faker->company(),
            'establishment_fees' => $this->faker->randomFloat(2, 1000, 5000),
            'fees' => $this->faker->randomFloat(2, 500, 3000),
            'remaining_amount' => $this->faker->randomFloat(2, 0, 1000),
            'advance_amount' => $this->faker->randomFloat(2, 0, 1000),
            'notes' => $this->faker->sentence(),
        ];
    }
}
