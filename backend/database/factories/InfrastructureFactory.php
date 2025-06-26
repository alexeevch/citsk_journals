<?php

namespace Database\Factories;

use App\Models\Infrastructure;
use App\Models\Owner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

/**
 * @extends Factory<Model>
 */
class InfrastructureFactory extends Factory
{
    protected $model = Infrastructure::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "ipv4"     => $this->faker->ipv4(),
            "name"     => $this->faker->company(),
            'owner_id' => function () {
                return Owner::factory()->create()->id;
            },
        ];
    }
}
