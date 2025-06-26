<?php

namespace Database\Factories;

use App\Models\Attacker;
use App\Models\Incident;
use App\Models\IncidentStatus;
use App\Models\IncidentType;
use App\Models\Infrastructure;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Incident>
 */
class IncidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Incident::class;

    public function definition(): array
    {
        return [
            'attacker_id'           => function () {
                return Attacker::factory()->create()->id;
            },
            'infrastructure_id'     => function () {
                return Infrastructure::factory()->create()->id;
            },
            'type_id'               => IncidentType::pluck("id")->random(),
            'status_id'             => IncidentStatus::pluck("id")->random(),
            'description'           => $this->faker->text(255),
            "detection_datetime"        => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            "group_alert_datetime"      => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
            "supervisor_alert_datetime" => $this->faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        ];
    }
}
