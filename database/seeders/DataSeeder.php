<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
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

        Admin::create([
            'name' => 'Maureen Lueilwitz',
            'email' => 'admin.2024@secure-system.io',
            'password' => bcrypt('your_password'),
            'phone' => '952.493.3881',
            'image' => 'uploads/images/default/default-image.jpeg',
        ]);
    }
}
