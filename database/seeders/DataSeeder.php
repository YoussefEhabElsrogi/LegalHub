<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Super Admin
        Admin::updateOrCreate(
            ['email' => 'superadmin@superadmin.com'],
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@superadmin.com',
                'password' => '123123123',
                'phone' => '01124684262',
                'role' => 'superadmin',
                'image' => 'uploads/images/default/default-image.jpeg'
            ]
        );

        // Regular Admin
        Admin::updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Maureen Lueilwitz',
                'password' => '123123123',
                'phone' => '952.493.3881',
                'role' => 'admin',
                'image' => 'uploads/images/default/default-image.jpeg',
            ]
        );
    }
}
