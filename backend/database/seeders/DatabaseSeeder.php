<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\IncidentType;
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
    }
}
