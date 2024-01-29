<?php

namespace Database\Seeders;

use App\Models\IncidentType;
use Illuminate\Database\Seeder;

class IncidentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IncidentType::factory()->create([
            'name'        => 'DDOS',
            'description' => 'DDoS-атака (или Denial of Service, или «отказ в обслуживании») — это попытка злоумышленников так загрузить сервер, чтобы он просто перестал работать.'
        ]);
    }
}
