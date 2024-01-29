<?php

namespace Database\Seeders;

use App\Models\IncidentStatus;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class IncidentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            "Новая",
            "Закрыта"
        ];

        IncidentStatus::factory()
                      ->count(count($statuses))
                      ->sequence(fn(Sequence $sequence) => ['name' => $statuses[$sequence->index]])
                      ->create();
    }
}
