<?php

namespace Database\Factories;

use App\Models\IncidentStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<IncidentStatus>
 */
class IncidentStatusFactory extends Factory
{
    protected $model = IncidentStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name(),
        ];
    }
}
