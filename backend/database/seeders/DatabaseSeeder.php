<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(IncidentTypeSeeder::class);
        $this->call(IncidentStatusSeeder::class);
        $this->call(IncidentSeeder::class);
        $this->call(RolesAndPermissionsSeeder::class);
    }
}
