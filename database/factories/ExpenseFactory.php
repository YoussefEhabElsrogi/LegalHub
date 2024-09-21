<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expense>
 */
class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'case' => $this->faker->word(), 
            'expense_name' => $this->faker->word(), // اسم المصروف العشوائي
            'amount' => $this->faker->randomFloat(2, 50, 1000), // مبلغ عشوائي بين 50 و 1000
            'notes' => $this->faker->sentence(), // جملة عشوائية تمثل الملاحظات
        ];
    }
}
