<?php

namespace Database\Seeders;

use App\Models\Admin;
use Database\Factories\AdminFactory;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'youssef@gmail.com'],
            [
                'name' => 'يوسف السروجي',
                'email' => 'youssef@gmail.com',
                'password' => 'Youssef0112005#',
                'phone' => '01124684262',
                'role' => 'superadmin',
                'image' => 'uploads/images/default/default-image.jpeg'
            ]
        );
        Admin::factory()->count(20)->create();
    }
}
