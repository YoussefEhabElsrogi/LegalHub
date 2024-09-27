<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Procuration;
use App\Models\Session;
use App\Models\File;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = Client::factory()->count(15)->create();

        $clients->each(function ($client) {

            $procuration = Procuration::factory(10)->create(['client_id' => $client->id]);

            foreach ($procuration as $procuration) {
                File::factory()->count(2)->create([
                    'fileable_id' => $procuration->id,
                    'fileable_type' => Procuration::class,
                ]);
            }

            $sessions = Session::factory(4)->create(['client_id' => $client->id]);

            foreach ($sessions as $session) {
                File::factory()->count(2)->create([
                    'fileable_id' => $session->id,
                    'fileable_type' => Session::class,
                ]);
            }
        });
    }
}
