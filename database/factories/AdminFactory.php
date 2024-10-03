<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('123123123'), // password
            'phone' => fake()->phoneNumber(),
            // 'role' => fake()->randomElement(['admin', 'superadmin']),
            'image' => 'uploads/images/default/default-image.jpeg',
            'remember_token' => Str::random(10),
        ];
    }
}
