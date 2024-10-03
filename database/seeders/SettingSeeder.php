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
        Setting::updateOrCreate(['facebook'=>'https://www.facebook.com/Elbig.Kim000?mibextid=ZbWKwL'],
            [
                'facebook' => 'https://www.facebook.com/Elbig.Kim000?mibextid=ZbWKwL',
                'instagram' => 'https://www.instagram.com/___kim000___?igsh=MTl6Ymlocmh2bTJoaw==',
                'twitter' => 'https://x.com/Km00018?t=yLBQW2l5BoU7qBeucccR2Q&s=09',
            ]
        );
    }
}
