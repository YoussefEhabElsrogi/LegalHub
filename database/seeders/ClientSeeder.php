<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use App\Models\Expense;
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

            Company::factory()->count(5)->create(['client_id' => $client->id]);

            Expense::factory()->count(5)->create(['client_id' => $client->id]);

            $procurations = Procuration::factory(10)->create(['client_id' => $client->id]);

            foreach ($procurations as $procuration) {
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
