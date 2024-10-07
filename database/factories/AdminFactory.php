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
            'email' => 'admin.2024@secure-system.io',
            'password' => bcrypt('C0mpl3xP@ssw0rd#Adm!n2024'),
            'phone' => fake()->phoneNumber(),
            'image' => 'uploads/images/default/default-image.jpeg',
            'remember_token' => Str::random(10),
        ];
    }
}
