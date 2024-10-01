<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::updateOrCreate(
            [
                'facebook' => 'https://facebook.com/',
                'instagram' => 'https://instagram.com/',
                'twitter' => 'https://twitter.com/',
            ]
        );
    }
}
