<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $incidentType = $this->call(IncidentTypeSeeder::class);
        $incidentStatus = $this->call(IncidentStatusSeeder::class);
        $incident = $this->call(IncidentSeeder::class);
    }
}
