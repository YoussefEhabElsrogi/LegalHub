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
            ['email' => 'superadmin.2024@secure-system.io'],
            [
                'name' => 'كريم عادل',
                'email' => 'superadmin.2024@secure-system.io',
                'password' => 'S3cur3Pa$$w0rd!2024#Admin',
                'phone' => '01124684262',
                'role' => 'superadmin',
                'image' => 'uploads/images/default/default-image.jpeg'
            ]
        );
        Admin::factory()->count(1)->create();
    }
}
